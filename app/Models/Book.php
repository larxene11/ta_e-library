<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $primaryKey = 'kode_buku';
    protected $keyType = 'string';
    protected $fillable = ['kode_buku', 'judul', 'category_id', 'pengarang', 'dana', 'tahun', 'description'];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['category'] ?? false, function ($query, $category) {
            return $query->whereHas('category', function ($query) use ($category) {
                $query->where('name', $category);
            });
        });

        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('judul', 'like', '%' . $search . '%')->orWhere('kode_buku', function ($query) use ($search) {
                $query->orWhere('pengarang', 'like', '%' . $search . '%');
            });
        });
    }

    //relation
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function pinjaman()
    {
        return $this->hasMany(Pinjaman::class, 'kode_buku');
    }

    // boot
    public static function boot()
    {
        parent::boot();

        self::creating(function ($book) {
            $book->id = request()->kode_buku;
        });

        self::created(function ($book) {
            foreach (request()->file('images') ?? [] as $key => $image) {
                $uploaded = Image::uploadImage($image);
                Image::create([
                    'thumb' => 'thumbnails/' . $uploaded['thumb']->basename,
                    'src' => 'images/' . $uploaded['src']->basename,
                    'alt' => Image::getAlt($image),
                    'imageable_id' => $book->id,
                    'imageable_type' => "App\Models\Book"
                ]);
            }
        });

        self::updating(function ($book) {

            $img_array = explode(',', request()->deleted_images);
            array_pop($img_array);

            // dd($img_array);
            // dd(Image::whereIn('id', $img_array)->get());
            foreach ($img_array as $key => $image_id) {
                $will_deleted_image = Image::find($image_id);
                if (!is_null($will_deleted_image)) {
                    $will_deleted_image->delete();
                }
            }

            foreach (request()->file('images') ?? [] as $key => $image) {
                $uploaded = Image::uploadImage($image);
                Image::create([
                    'thumb' => 'thumbnails/' . $uploaded['thumb']->basename,
                    'src' => 'images/' . $uploaded['src']->basename,
                    'alt' => Image::getAlt($image),
                    'imageable_id' => $book->id,
                    'imageable_type' => "App\Models\Book"
                ]);
            }
        });

        self::updated(function ($model) {
            // ... code here
        });

        self::deleting(function ($book) {
            foreach ($book->images as $key => $image) {
                $image->delete();
            }
        });

        self::deleted(function ($book) {
        });
    }

}

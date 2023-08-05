<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Book extends Model
{
    use HasFactory;
    protected $table = 'books'; // Nama tabel di database
    protected $primaryKey = 'kode_buku';
    protected $keyType = 'string';
    protected $fillable = ['kode_buku', 'judul', 'category_id', 'pengarang', 'dana', 'tahun', 'description', 'penerbit', 'tahun_terbit', 'status', 'no_rak'];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['category'] ?? false, function ($query, $category) {
            return $query->whereHas('category', function ($query) use ($category) {
                $query->where('name', $category);
            });
        });
    
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('judul', 'like', '%' . $search . '%')
                         ->orWhere(function ($query) use ($search) {
                             $query->where('kode_buku', 'like', '%' . $search . '%')
                                   ->orWhere('pengarang', 'like', '%' . $search . '%');
                         });
        });
    }

    //relation
    public function images()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function pinjaman()
    {
        return $this->hasMany(Pinjaman::class, 'kode_buku');
    }

    public static function boot()
    {
        parent::boot();

        self::creating(function ($book) {
            $book->id = request()->kode_buku;
        });

        self::created(function ($book) {
            $image = request()->file('image');
            $uploaded = Image::uploadImage($image);
            Image::create([
                'thumb' => 'thumbnails/' . $uploaded['thumb']->basename,
                'src' => 'images/' . $uploaded['src']->basename,
                'alt' => Image::getAlt($image),
                'imageable_id' => $book->id,
                'imageable_type' => "App\Models\Book"
            ]);
        });

        self::updating(function ($book) {
            $new_image = request()->file('image');
            if (request()->hasFile('image')) {
                $book->images()->delete();
                $updated = Image::uploadImage($new_image);
                Image::create([
                    'thumb' => 'thumbnails/' . $updated['thumb']->basename,
                    'src' => 'images/' . $updated['src']->basename,
                    'alt' => Image::getAlt($new_image),
                    'imageable_id' => $book->id,
                    'imageable_type' => "App\Models\Book"
                ]);
            }
        });

        self::deleted(function ($book) {
            $book->images()->delete();
        });
    }
}

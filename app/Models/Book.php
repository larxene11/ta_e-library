<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Book extends Model
{
    use HasFactory;
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
            return $query->where('judul', 'like', '%' . $search . '%')->orWhere('kode_buku', function ($query) use ($search) {
                $query->orWhere('pengarang', 'like', '%' . $search . '%');
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
            if (request()->hasFile('image')) {
                $uploaded = Image::uploadImage(request()->file('image'));
                $book->image()->create([
                    'alt' => Image::getAlt(request()->file('image')),
                    'src' => 'images/' . $uploaded['src']->basename,
                    'thumb' => 'thumbnails/' . $uploaded['thumb']->basename,
                    'imageable_id' => $book->id,
                    'imageable_type' => "App\Models\Book"
                ]);
            }
        });

        self::updating(function ($book) {
            // ... code here
        });

        self::updated(function ($book) {
            if (request()->hasFile('image')) {
                $uploaded = Image::uploadImage(request()->file('image'));
                if ($book->image ?? false) {
                    Storage::delete($book->image->thumb);
                    Storage::delete($book->image->src);
                }
                $book->image()->update([
                    'alt' => Image::getAlt(request()->file('image')),
                    'src' => 'images/' . $uploaded['src']->basename,
                    'thumb' => 'thumbnails/' . $uploaded['thumb']->basename,
                    'imageable_id' => $book->id,
                    'imageable_type' => "App\Models\Book"
                ]);
            }
        });

        self::deleted(function ($book) {
            $book->image()->delete();
        });
    }
}

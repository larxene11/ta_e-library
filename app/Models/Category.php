<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description'];

    public function books()
    {
        return $this->hasMany(Book::class, 'category_id');
    }
    public function images()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%');
            });
    }
    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            // ... code here
        });

        // self::created(function ($category) {
        //     if (request()->hasFile('image')) {
        //         $uploaded = Image::uploadImage(request()->file('image'));
        //         $category->image()->create([
        //             'alt' => Image::getAlt(request()->file('image')),
        //             'src' => 'images/' . $uploaded['src']->basename,
        //             'thumb' => 'thumbnails/' . $uploaded['thumb']->basename,
        //             'imageable_id' => $category->id,
        //             'imageable_type' => "App\Models\Category"
        //         ]);
        //     }
        // });

        // self::updating(function ($model) {
        //     // ... code here
        // });

        // self::updated(function ($category) {
        //     if (request()->hasFile('image')) {
        //         $uploaded = Image::uploadImage(request()->file('image'));
        //         if ($category->image ?? false) {
        //             Storage::delete($category->image->thumb);
        //             Storage::delete($category->image->src);
        //         }
        //         $category->image()->update([
        //             'alt' => Image::getAlt(request()->file('image')),
        //             'src' => 'images/' . $uploaded['src']->basename,
        //             'thumb' => 'thumbnails/' . $uploaded['thumb']->basename,
        //             'imageable_id' => $category->id,
        //             'imageable_type' => "App\Models\Category"
        //         ]);
        //     }
        // });

        // self::deleting(function ($model) {
        //     // ... code here
        // });

        // self::deleted(function ($model) {
        //     Book::whereIn('kode_buku', $model->book->map(fn ($item) => $item->kode_buku))->update(['category_id', NULL]);
        // });
    }
}

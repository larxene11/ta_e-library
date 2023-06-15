<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description'];

    public function books()
    {
        return $this->hasMany(Book::class, 'category_id');
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%')->orWhereHas('books', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')->orWhere('kode_buku', '=', $search);
            });
        });
    }
    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            // ... code here
        });

        self::created(function ($model) {
            // ... code here
        });

        self::updating(function ($model) {
            // ... code here
        });

        self::updated(function ($model) {
            // ... code here
        });

        self::deleting(function ($model) {
            // ... code here
        });

        self::deleted(function ($model) {
            Book::whereIn('kode_buku', $model->book->map(fn ($item) => $item->kode_buku))->update(['category_id', NULL]);
        });
    }
}

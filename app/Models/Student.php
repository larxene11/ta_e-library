<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Student extends Model
{
    use HasFactory;
    protected $fillable = ['nis', 'alamat', 'jurusan', 'nisn', 'no_tlp'];

    //relations
    public function user(): MorphMany
    {
        return $this->morphMany(User::class, 'userable');
    }

    public function pinjaman()
    {
        return $this->hasMany(Pinjaman::class, 'nis');
    }

    // bootable
    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
        });

        self::created(function ($model) {
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
            $model->detail()->delete();
        });
    }
}

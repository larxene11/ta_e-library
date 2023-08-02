<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kunjungan extends Model
{
    use HasFactory;
    protected $fillable = ['nama', 'nis', 'alasan_berkunjung', 'tgl_berkunjung'];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('nama', 'like', '%' . $search . '%');
        });
    }

    // public function kunjungan()
    // {
    //     return $this->hasMany(User::class, 'nis_nip');
    // }

    // // bootable
    // public static function boot()
    // {
    //     parent::boot();

    //     self::creating(function ($model) {
    //     });

    //     self::created(function ($model) {
    //     });

    //     self::updating(function ($model) {
    //         // ... code here
    //     });

    //     self::updated(function ($model) {
    //         // ... code here
    //     });

    //     self::deleting(function ($model) {
    //         // ... code here
    //     });

    //     self::deleted(function ($model) {
    //         $model->detail()->delete();
    //     });
    // }
}

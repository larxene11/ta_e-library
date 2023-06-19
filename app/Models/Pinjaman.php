<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pinjaman extends Model
{
    use HasFactory;
    protected $fillable = ['kode_buku', 'nis', 'tgl_pinjaman', 'tgl_pengembalian', 'status_pengembalian', 'denda'];

    // public function scopeFilter($query, array $filters)
    // {
    //     $query->when($filters['period'] ?? false, function ($query, $period) {
    //         $periods = explode("-", $period);
    //         $year = $periods[0];
    //         $month = $periods[1];
    //         return $query->whereMonth('created_at', $month)->whereYear('created_at', $year);
    //     });
    //     $query->when($filters['search'] ?? false, function ($query, $search) {
    //         return $query->where('name', 'like', '%' . $search . '%')->WhereHas('details', function ($query) use ($search) {
    //             $query->orWhere('name', 'like', '%' . $search . '%')->orWhere('kode_buku', '=', $search);
    //         })->WhereHas('student', function ($query) use ($search) {
    //             $query->orWhere('name', 'like', '%' . $search . '%')->orWhere('phone', 'like', '%' . $search . '%');
    //         });
    //     });
    // }

    //relations
    public function student()
    {
        return $this->hasMany(Student::class, 'nis');
    }
    public function book()
    {
        return $this->hasMany(Book::class, 'kode_buku');
    }

    // public function hitungDenda()
    // {
    //     $tanggalPengembalian = $this->tgl_pengembalian;
    //     $tanggalBatas = $this->tanggal_batas_pengembalian;

    //     // Menghitung selisih hari antara tanggal pengembalian dengan tanggal batas
    //     $tanggalPengembalian = \Carbon\Carbon::parse($tanggalPengembalian);
    //     $tanggalBatas = \Carbon\Carbon::parse($tanggalBatas);
    //     $selisihHari = $tanggalPengembalian->diffInDays($tanggalBatas, false);

    //     // Menghitung denda per hari (misalnya Rp 1.000 per hari)
    //     $dendaPerHari = 1000;

    //     // Menghitung total denda
    //     $totalDenda = ($selisihHari > 0) ? $selisihHari * $dendaPerHari : 0;

    //     return $totalDenda;
    // }

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

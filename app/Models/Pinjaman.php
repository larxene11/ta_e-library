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
    public function user()
    {
        return $this->hasMany(User::class, 'nis_nip');
    }
    public function book()
    {
        return $this->hasMany(Book::class, 'book_id');
    }

    // // Fungsi untuk menangani pengembalian buku
    // public function selesaiPinjam()
    // {
    //     $this->book->status = 'Ada';
    //     $this->book->save();
    // }
}

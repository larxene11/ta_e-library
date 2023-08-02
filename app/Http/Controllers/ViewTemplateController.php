<?php

namespace App\Http\Controllers;
use App\Models\Book;
use App\Models\User;
use App\Models\Pinjaman;
use App\Models\Kunjungan;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ViewTemplateController extends Controller
{
    public function dashboard()
    {
        // Mendapatkan tanggal awal dan akhir bulan sekarang
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        $currentDate = Carbon::now();
        $today = $currentDate->format('d-m-Y');

        $bukuPalingBanyak = Book::withCount(['pinjaman' => function ($query) use ($startOfMonth, $endOfMonth) {
            // Menambahkan kondisi untuk hanya menghitung peminjaman dalam rentang bulan ini
            $query->whereBetween('tgl_pinjaman', [$startOfMonth, $endOfMonth]);
        }])
        ->orderBy('pinjaman_count', 'desc')
        ->first();

        if ($bukuPalingBanyak) {
            // Get all book data that belongs to the most borrowed book
            $booksOfMostBorrowed = $bukuPalingBanyak->pinjaman;
        } else {
            $booksOfMostBorrowed = null; // Atau dapat diisi dengan array kosong []
        }

        $data = [
            'title' => 'Dashboard Pegawai | E-Library SMANDUTA',
            'user' => User::where('level', 'siswa')->get(),
            'pinjaman' => Pinjaman::all(),
            'books' => Book::all(),
            'kunjungan' => Kunjungan::all(),
            'today' => $today,
            'bookOfMonth' => $bukuPalingBanyak,
            'booksOfMostBorrowed' => $booksOfMostBorrowed,
        ];
        return view('admin.dashboard.index', $data);
        
        
    }
}

<?php

namespace App\Http\Controllers;

use App\Events\PinjamanCreated;
use App\Events\PinjamanUpdated;
use App\Models\Pinjaman;
use App\Models\Book;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class PinjamanController extends Controller
{
    public function allPinjaman()
    {
        $data = [
            'title' => 'Pinjaman | E-Library SMANDUTA',
            'pinjaman' => Pinjaman::latest()->get(),
            'books' => Book::latest()->get(),
            'users' => User::where('level', 'siswa')->latest()->get()
        ];
        return view('admin.pinjaman.pinjaman-all', $data);
    }
    public function createPinjaman()
    {
        $data = [
            'title' => 'Add New Pinjaman | E-Library SMANDUTA',
            'books' => Book::latest()->get(),
            'users' => User::where('level', 'siswa')->latest()->get()
        ];
        return view('admin.pinjaman.pinjaman-add', $data);
    }
    // public function detailPinjaman(Pinjaman $pinjaman)
    // {
    //     $data = [
    //         'title' => 'Pinjaman Detail | E-Library SMANDUTA',
    //         'pinjaman' => $pinjaman
    //     ];
    //     return view('admin.pinjaman.pinjaman-detail', $data);
    // }
    public function updatePinjaman(Pinjaman $pinjaman)
    {
        $data = [
            'title' => 'Pinjaman Update | E-Library SMANDUTA',
            'pinjaman' => $pinjaman,
            'books' => Book::latest()->get(),
            'users' => User::where('level', 'siswa')->latest()->get()
        ];
        return view('admin.pinjaman.pinjaman-edit', $data);
    }
    
    public function storePinjaman(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_buku' => 'required|string',
            'nis' => 'required|integer',
            'tgl_pinjaman' => 'required|date',
            'tgl_pengembalian' => 'required|date',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Input Failed!<br>Please Try Again With Correct Input');
        }
        $validated = $validator->validated();
        $created_pinjaman = Pinjaman::create([
            'kode_buku' => $validated['kode_buku'],
            'nis' => $validated['nis'],
            'tgl_pinjaman' => $validated['tgl_pinjaman'],
            'tgl_pengembalian' => $validated['tgl_pengembalian'],
        ]);
        event(new PinjamanCreated($created_pinjaman));
        if ($created_pinjaman) {
            return redirect()->route('manage_pinjaman.all')->with('success', 'Data Pinjaman Berhasil Ditambahkan');
        }
        return redirect()->back()->with('error', 'Error Occured, Please Try Again!');
    }

    public function patchPinjaman(Request $request, Pinjaman $pinjaman)
    {
        $validator = Validator::make($request->all(), [
            'kode_buku' => 'required|string',
            'nis' => 'required|integer',
            'tgl_pinjaman' => 'required|date',
            'tgl_pengembalian' => 'required|date',
            'status_pengembalian' => 'required|string',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Input Failed!<br>Please Try Again With Correct Input');
        }
        $validated = $validator->validated();
        $pinjaman->touch();
        $updated_pinjaman = $pinjaman->update([
            'kode_buku' => $validated['kode_buku'],
            'nis' => $validated['nis'],
            'tgl_pinjaman' => $validated['tgl_pinjaman'],
            'tgl_pengembalian' => $validated['tgl_pengembalian'],
            'status_pengembalian' => $validated['status_pengembalian'],
        ]);
        event(new PinjamanUpdated($pinjaman));
        if ($updated_pinjaman) {
            return redirect()->route('manage_pinjaman.all')->with('success', 'Data Pinjaman Berhasil Di Ubah');
        }
        return redirect()->back()->with('error', 'Error Occured, Please Try Again!');
    }
    public function deletePinjaman(Pinjaman $pinjaman)
    {
        if ($pinjaman->delete()) {
            return redirect()->route('manage_pinjaman.all')->with('success', 'Data Pinjaman Berhasil Dihapus');
        }
        return redirect()->back()->with('error', 'Error Occured, Please Try Again!');
    }
}

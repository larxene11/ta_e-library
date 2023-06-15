<?php

namespace App\Http\Controllers;

use App\Models\Kunjungan;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class KunjunganController extends Controller
{
    public function allKunjungan()
    {
        $data = [
            'title' => 'Kunjungan | E-Library SMANDUTA',
            'kunjungan' => Kunjungan::latest()->filter(request(['search']))->paginate(10)->withQueryString(),
        ];
        return view('admin.kunjungan.kunjungan-all', $data);
    }
    public function createKunjungan()
    {
        $data = [
            'title' => 'Add New Kunjungan | E-Library SMANDUTA',
        ];
        return view('admin.kunjungan.kunjungan-add', $data);
    }
    // public function detailPinjaman(Pinjaman $pinjaman)
    // {
    //     $data = [
    //         'title' => 'Pinjaman Detail | E-Library SMANDUTA',
    //         'pinjaman' => $pinjaman
    //     ];
    //     return view('admin.pinjaman.pinjaman-detail', $data);
    // }
    public function updateKunjungan(kunjungan $kunjungan)
    {
        $data = [
            'title' => 'Kunjungan Update | E-Library SMANDUTA',
            'kunjungan' => $kunjungan,
        ];
        return view('admin.kunjungan.kunjungan-edit', $data);
    }
    public function storeKunjungan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nis' => 'required|integer',
            'nama' => 'required|string',
            'alasan_berkunjung' => 'required|text',
            'tgl_berkunjung' => 'required|date',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Input Failed!<br>Please Try Again With Correct Input');
        }
        $validated = $validator->validated();
        $created_kunjungan = Kunjungan::create([
            'nis' => $validated['nis'],
            'nama' => $validated['nama'],
            'alasan_berkunjung' => $validated['alasan_berkunjung'],
            'tgl_berkunjung' => $validated['tgl_berkunjung'],
        ]);
        if ($created_kunjungan) {
            return redirect()->route('manage_kunjungan.all')->with('success', 'Data Pinjaman Berhasil Ditambahkan');
        }
        return redirect()->back()->with('error', 'Error Occured, Please Try Again!');
    }
    public function patchKunjungan(Request $request, Kunjungan $kunjungan)
    {
        $validator = Validator::make($request->all(), [
            'kode_buku' => 'required|string',
            'nis' => 'required|integer',
            'tgl_pinjaman' => 'required|date',
            'tgl_pengembalian' => 'required|date',
            'status_pengembalian' => 'required|enum',
            'denda' => 'required|float',
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
            'denda' => $validated['denda'],
        ]);
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



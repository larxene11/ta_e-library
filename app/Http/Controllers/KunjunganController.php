<?php

namespace App\Http\Controllers;

use App\Models\Kunjungan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Validator;

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

    public function exportPdf()
    {
        $kunjungan = Kunjungan::all();
        $pdf = Pdf::loadView('pdf.kunjungan-pdf', ['pinjaman' => $kunjungan]);
        return $pdf->download('LaporanKunjungan-'.Carbon::now()->timestamp.'.pdf');
    }
    // public function detailkunjungan(kunjungan $kunjungan)
    // {
    //     $data = [
    //         'title' => 'kunjungan Detail | E-Library SMANDUTA',
    //         'kunjungan' => $kunjungan
    //     ];
    //     return view('admin.kunjungan.kunjungan-detail', $data);
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
            'alasan_berkunjung' => 'required|string',
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
            return redirect()->route('manage_kunjungan.all')->with('success', 'Data kunjungan Berhasil Ditambahkan');
        }
        return redirect()->back()->with('error', 'Error Occured, Please Try Again!');
    }

    public function patchKunjungan(Request $request, Kunjungan $kunjungan)
    {
        $validator = Validator::make($request->all(), [
            'nis' => 'required|integer',
            'nama' => 'required|string',
            'alasan_berkunjung' => 'required|string',
            'tgl_berkunjung' => 'required|date',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Input Failed!<br>Please Try Again With Correct Input');
        }
        $validated = $validator->validated();
        $kunjungan->touch();
        $updated_kunjungan = $kunjungan->update([
            'nis' => $validated['nis'],
            'nama' => $validated['nama'],
            'alasan_berkunjung' => $validated['alasan_berkunjung'],
            'tgl_berkunjung' => $validated['tgl_berkunjung'],
        ]);
        if ($updated_kunjungan) {
            return redirect()->route('manage_kunjungan.all')->with('success', 'Data kunjungan Berhasil Di Ubah');
        }
        return redirect()->back()->with('error', 'Error Occured, Please Try Again!');
    }
    
    public function deletekunjungan(kunjungan $kunjungan)
    {
        if ($kunjungan->delete()) {
            return redirect()->route('manage_kunjungan.all')->with('success', 'Data kunjungan Berhasil Dihapus');
        }
        return redirect()->back()->with('error', 'Error Occured, Please Try Again!');
    }
}



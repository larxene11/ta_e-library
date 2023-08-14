<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Book;
use App\Models\User;
use App\Models\Pinjaman;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class PinjamanController extends Controller
{
    public function allPinjaman()
    {
        $data = [
            'title' => 'Pinjaman | E-Library SMANDUTA',
            'pinjaman' => Pinjaman::latest()->filter(request(['search']))->paginate(10)->withQueryString(),
            'books' => Book::latest()->get(),
            'users' => User::where('level', 'siswa')->latest()->get()
        ];
        return view('admin.pinjaman.pinjaman-all', $data);
    }

    public function exportPdf(Request $request)
    {
        $tglawal = Carbon::parse($request->tglawal)->startOf('day')->toDateTimeString();
        $tglakhir = Carbon::parse($request->tglakhir)->endOf('day')->toDateTimeString();

        $pinjaman = Pinjaman::where('status_pengembalian', 'sudah')->whereBetween('tgl_pengembalian', [$tglawal, $tglakhir])->get();

        $pdf = Pdf::loadView('pdf.pinjaman-pdf', compact('pinjaman'))->setPaper('A4');;
        return $pdf->download('LaporanPinjaman-' . Carbon::now()->timestamp . '.pdf');
    }
    
    public function createPinjaman()
    {
        // // Ambil gambar profil siswa menggunakan polimorfisme
        // $gambarProfil = Gambar::where('imageable_type', 'App\Models\Siswa')
        //                       ->where('imageable_id', $user->id)
        //                       ->first();

        $data = [
            'title' => 'Add New Pinjaman | E-Library SMANDUTA',
            'books' => Book::latest()->get(),
            'users' => User::where('level', 'siswa')->with('images')->latest()->get()
        ];
        return view('admin.pinjaman.pinjaman-add', $data);
    }

    public function getGambar($nis)
    {
        $user = User::where('level', 'siswa')->where('nis_nip', $nis)->first();

        if ($user) {
            $gambar = $user->images()->first(); // Menggunakan relasi images
            if ($gambar) {
                $gambarPath = asset('storage/' . $gambar->src); // Path gambar
                return response()->json(['gambar' => $gambarPath]);
            }
        }

        return response()->json(['gambar' => null]);
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
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Input Failed!<br>Please Try Again With Correct Input');
        }
        $validated = $validator->validated();
        // Menggunakan Carbon untuk mengisi tanggal secara otomatis
        $tgl_pinjaman = Carbon::now(); // Tanggal saat ini
        $tgl_pengembalian = Carbon::now()->addDays(7); // Tambah 7 hari dari tanggal saat ini
        $books = Book::findOrFail($request->kode_buku)->only('status');
        $denda = '0';
        

        if ($books['status'] != 'ada') {
            Session::flash('error', 'Buku saat ini tidak tersedia');
            return redirect('manage_pinjaman.create');
        } else {
            $count = Pinjaman::where('nis', $request->nis)->where('status_pengembalian', 'belum')->count();
    
            if ($count >= 3) {
                Session::flash('error', 'Siswa sudah mencapai limit peminjaman <br> Tolong kembalikan buku kembali');
                return redirect('manage_pinjaman.create');
            } else {
                try {
                    DB::beginTransaction();
    
                    // Simpan data pinjaman
                    Pinjaman::create([
                        'kode_buku' => $validated['kode_buku'],
                        'nis' => $validated['nis'],
                        'tgl_pinjaman' => $tgl_pinjaman,
                        'tgl_pengembalian' => $tgl_pengembalian,
                        'denda' =>$denda
                    ]);
    
                    // Perbarui status buku menjadi 'tidak'
                    $books = Book::findOrFail($request->kode_buku);
                    $books->status = 'tidak';
                    $books->save();
    
                    DB::commit(); // Commit transaksi jika tidak ada error
    
                    return redirect()->route('manage_pinjaman.all')->with('success', 'Data Pinjaman Berhasil Ditambahkan');
                } catch (\Throwable $th) {
                    DB::rollBack(); // Rollback transaksi jika terjadi error
                    return redirect()->back()->with('error', 'Error Occurred, Please Try Again!');
                }
            }
        }
    }

    public function patchPinjaman(Request $request, Pinjaman $pinjaman)
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
        $pinjaman->touch();
        $updated_pinjaman = $pinjaman->update([
            'kode_buku' => $validated['kode_buku'],
            'nis' => $validated['nis'],
            'tgl_pinjaman' => $validated['tgl_pinjaman'],
            'tgl_pengembalian' => $validated['tgl_pengembalian'],
        ]);
        // event(new PinjamanUpdated($pinjaman));
        if ($updated_pinjaman) {
            return redirect()->route('manage_pinjaman.all')->with('success', 'Data Pinjaman Berhasil Di Ubah');
        }
        return redirect()->back()->with('error', 'Error Occured, Please Try Again!');
    }

    public function kembaliBuku(){
        $data = [
            'title' => 'Pengembalian Buku | E-Library SMANDUTA',
            'books' => Book::where('status', 'tidak')->latest()->get(),
            'users' => User::where('level', 'siswa')->has('pinjaman')->with('pinjaman')->latest()->get()
        ];
        return view('admin.pinjaman.kembali-buku', $data);
    }

    public function saveKembali(Request $request){
        $rent = Pinjaman::where('nis', $request->nis)->where('kode_buku',$request->kode_buku)
        ->where('status_pengembalian', 'belum');
        $rentData = $rent->first();
        $countRent = $rent->count();

        if ($countRent == 1) {
            // Calculate late fees if book is returned late
            $dueDate = $rentData->tgl_pengembalian;
            $today = now();
            $lateDays = max(0, $today->diffInDays($dueDate));
            $lateFeeRate = 1000; // 1k per day
    
            // Calculate total late fee
            $lateFee = $lateDays * $lateFeeRate;
    
            // Update the status and late fee in Pinjaman model
            $rentData->status_pengembalian = 'sudah';
            $rentData->denda = $lateFee;
            $rentData->save();
    
            // Perbarui status buku menjadi 'ada'
            $books = Book::findOrFail($request->kode_buku);
            $books->status = 'ada';
            $books->save();
    
            return redirect()->route('manage_pinjaman.all')->with('success', 'Buku Berhasil dikembalikan. Denda: ' . $lateFee);
        } else {
            return redirect()->back()->with('error', 'Error Occurred, Please Try Again!');
        }   
        
    }

    public function deletePinjaman(Pinjaman $pinjaman)
    {
        if ($pinjaman->delete()) {
            return redirect()->route('manage_pinjaman.all')->with('success', 'Data Pinjaman Berhasil Dihapus');
        }
        return redirect()->back()->with('error', 'Error Occured, Please Try Again!');
    }
}

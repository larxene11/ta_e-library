<?php

namespace App\Console;

use Carbon\Carbon;
use App\Models\Pinjaman;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {
            // Ambil semua data yang memerlukan perhitungan denda
            $data = Pinjaman::where('tgl_pengembalian', '<', Carbon::now())->get();
    
            foreach ($data as $item) {
                if (Carbon::now()->gt($item->tgl_pengembalian)){
                    if ($item->status_pengembalian !== 'sudah') {
                    // Hitung selisih hari antara tanggal jatuh tempo dan tanggal sekarang
                    $selisihHari = Carbon::now()->diffInDays($item->tgl_pengembalian);
        
                    // Hitung jumlah denda per hari
                    $dendaPerHari = 1000; // Misalnya, denda 1% per hari dari jumlah
        
                    // Hitung total denda
                    $totalDenda = $selisihHari * $dendaPerHari;
        
                    // Update nilai denda ke dalam field database
                    $item->denda = $totalDenda;
                    $item->save();
                    }
                }
            }
        })->daily(); // Atur jadwal eksekusi tugas ini, misalnya setiap hari
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}

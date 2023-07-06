<?php

namespace App\Console\Commands;

use App\Models\Pinjaman;
use Illuminate\Console\Command;

class CalculatePinalty extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:calculate-pinalty';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $loans = Pinjaman::where('sts', 'belum')->get();
        foreach ($loans as $loan) {
            $dueDate = $loan->tgl_pengembalian;
            $today = now()->toDateString();
        
            if ($today > $dueDate) {
                $daysLate = now()->diffInDays($dueDate);
                $penaltyAmount = 1000;
                $totalPenalty = $daysLate * $penaltyAmount;
        
                $loan->denda = $totalPenalty;
                $loan->save();
        
                $this->info("Denda untuk pinjaman ID $loan->id: $totalPenalty");
            }
        
            if ($loan->status == 'sudah') {
                // Hentikan perhitungan denda untuk pinjaman yang sudah dikembalikan
                break;
            }
        }
        

    }
}

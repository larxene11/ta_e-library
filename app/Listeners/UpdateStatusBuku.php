<?php

namespace App\Listeners;

use App\Events\PinjamanCreated;
use App\Events\PinjamanUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateStatusBuku implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\PinjamanCreated|\App\Events\PinjamanUpdated  $event
     * @return void
     */
    public function handle($event): void
    {
        // Ambil data buku yang terkait dengan data pinjaman yang baru ditambahkan
        $pinjaman = $event->pinjaman;
        $buku = $pinjaman->book->first();

        dd($buku);
        // Periksa status buku sebelumnya
        $previousStatus = $buku->status;

        // Periksa apakah status pinjaman adalah "selesai" atau "kembali".
        // Jika ya, atur status buku menjadi "Ada"; jika tidak, atur status buku menjadi "Tidak".
        if ($pinjaman->status_pengembalian === 'sudah') {
            $buku->status = 'ada';
        } else {
            $buku->status = 'tidak';
        }

        // Hanya simpan status buku jika status berubah
        if ($buku->status !== $previousStatus) {    
                $buku->save();
            }
        }
}

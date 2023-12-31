<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pinjamen', function (Blueprint $table) {
            $table->id();
            $table->string('kode_buku')->unique();
            $table->integer('nis')->unique();
            $table->date('tgl_pinjaman');
            $table->date('tgl_pengembalian');
            $table->enum('status_pengembalian', ['sudah', 'belum'])->default('belum');
            $table->float('denda');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pinjamen');
    }
};

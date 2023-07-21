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
        Schema::create('books', function (Blueprint $table) {
            $table->string('id')->unique()->primary();
            $table->string('kode_buku')->unique();
            $table->string('judul');
            $table->string('category_id')->nullable();
            $table->string('pengarang');
            $table->string('penerbit');
            $table->string('dana');
            $table->integer('tahun');
            $table->integer('tahun_terbit');
            $table->enum('status',['ada', 'tidak'])->default('ada');
            $table->integer('no_rak');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};

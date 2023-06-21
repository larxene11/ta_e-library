<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'nis_nip' => 7777,
            'name' => 'Awik',
            'alamat' => 'jln. cinta',
            'jurusan_jabatan' => 'Petinggi Perpustakaan',
            'tlp' => '089754321',
            'email' => "awik@gmail.com",
            'password' => Hash::make("password"),
            'level' => 'pegawai'
        ]);
        User::create([
            'nis_nip' => 890,
            'name' => 'Eka Ari',
            'alamat' => 'jln. putus',
            'jurusan_jabatan' => 'IPS',
            'tlp' => '089754321',
            'email' => "eka@gmail.com",
            'password' => Hash::make("password"),
        ]);
        
    }
}

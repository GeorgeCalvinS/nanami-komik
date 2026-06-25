<?php

namespace Database\Seeders;

use App\Models\Pengguna; // Pastikan memakai model Pengguna
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; // Wajib dipanggil untuk mengenkripsi password

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Buat Akun Admin (role_user = 1)
        Pengguna::updateOrCreate([
            'email_user' => 'admin@gmail.com',
        ], [
            'nama_user' => 'Admin Nanami',
            'password' => Hash::make('admin123'),
            'role_user' => 1,
        ]);

        // 2. Buat Akun Mahasiswa (role_user = 0)
        Pengguna::updateOrCreate([
            'email_user' => 'testing12@gmail.com',
        ], [
            'nama_user' => 'Mahasiswa Testing',
            'password' => Hash::make('user123'),
            'role_user' => 0,
        ]);
    }
}
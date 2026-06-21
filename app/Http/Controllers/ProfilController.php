<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    // Menampilkan halaman form edit profil milik mahasiswa itu sendiri
    public function edit()
    {
        // Mengambil data pengguna yang sedang login saat ini
        $pengguna = Auth::user();
        
        return view('profil.edit', compact('pengguna'));
    }

    // Memproses update data ke database
    public function update(Request $request)
    {
        // Validasi input dari mahasiswa
        $request->validate([
            'nama_user' => 'required|string|max:255',
            'email_user' => 'required|email',
        ]);

        // Mengambil ID mahasiswa yang sedang login (bukan dari URL, agar tidak bisa diretas)
        $user_login = Auth::user();
        
        // Mencari data pengguna tersebut di database
        $pengguna = Pengguna::findOrFail($user_login->ID_User);

        // Menyiapkan data yang boleh diubah (Nama dan Email saja, Role tidak boleh!)
        $dataUpdate = [
            'nama_user' => $request->nama_user,
            'email_user' => $request->email_user,
        ];

        // Jika mahasiswa mengisi form password baru, maka password di-update
        if ($request->filled('password')) {
            $dataUpdate['password'] = Hash::make($request->password);
        }

        // Eksekusi update
        $pengguna->update($dataUpdate);

        // Mengembalikan mahasiswa ke halaman profil
        return redirect()->route('profil.edit');
    }
}
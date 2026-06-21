<?php

namespace App\Http\Controllers;

use App\Models\RiwayatBaca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiwayatBacaController extends Controller
{
    // READ: Menampilkan daftar continue reading
    public function index()
    {
        $riwayat = RiwayatBaca::where('ID_Pengguna', Auth::id())->get();
        return view('profil.riwayat', compact('riwayat'));
    }

    // CREATE & UPDATE: Menyimpan progress bacaan (Otomatis dipanggil saat user membaca)
    public function store(Request $request)
    {
        $request->validate([
            'ID_Komik' => 'required|integer',
            'ID_Chapter' => 'required|integer',
            'halaman_terakhir' => 'required|integer'
        ]);

        // Cek apakah user sudah pernah membaca komik ini sebelumnya
        $riwayat = RiwayatBaca::where('ID_Pengguna', Auth::id())
                              ->where('ID_Komik', $request->ID_Komik)
                              ->first();

        if ($riwayat) {
            // Jika sudah ada riwayatnya, lakukan UPDATE ke chapter/halaman terbaru
            $riwayat->update([
                'ID_Chapter' => $request->ID_Chapter,
                'halaman_terakhir' => $request->halaman_terakhir
            ]);
        } else {
            // Jika belum pernah membaca komik ini, lakukan CREATE riwayat baru
            RiwayatBaca::create([
                'ID_Pengguna' => Auth::id(),
                'ID_Komik' => $request->ID_Komik,
                'ID_Chapter' => $request->ID_Chapter,
                'halaman_terakhir' => $request->halaman_terakhir
            ]);
        }

        return response()->json(['message' => 'Progress bacaan disimpan']); // Biasanya progress membaca dikirim via API/AJAX di background
    }

    // DELETE: Menghapus riwayat baca
    public function destroy($id)
    {
        $riwayat = RiwayatBaca::where('ID_Riwayat', $id)
                              ->where('ID_Pengguna', Auth::id())
                              ->firstOrFail();
                              
        $riwayat->delete();

        return redirect()->back();
    }
}
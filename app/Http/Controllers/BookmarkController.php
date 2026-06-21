<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{
    // READ: Menampilkan daftar bookmark milik user yang sedang login
    public function index()
    {
        $bookmarks = Bookmark::where('ID_Pengguna', Auth::id())->get();
        // Melempar data ke view buatan Fernando
        return view('profil.bookmark', compact('bookmarks'));
    }

    // CREATE: Menambahkan komik ke daftar bookmark
    public function store(Request $request)
    {
        $request->validate([
            'ID_Komik' => 'required|integer'
        ]);

        // Logika Kondisional: Cek agar komik tidak dimasukkan ke bookmark 2 kali
        $cekBookmark = Bookmark::where('ID_Pengguna', Auth::id())
                               ->where('ID_Komik', $request->ID_Komik)
                               ->first();

        if (!$cekBookmark) {
            Bookmark::create([
                'ID_Pengguna' => Auth::id(),
                'ID_Komik' => $request->ID_Komik
            ]);
        }

        return redirect()->back(); // Mengembalikan layar ke halaman sebelumnya
    }

    // DELETE: Menghapus komik dari bookmark
    public function destroy($id)
    {
        // Keamanan: Pastikan user hanya bisa menghapus bookmark miliknya sendiri
        $bookmark = Bookmark::where('ID_Bookmark', $id)
                            ->where('ID_Pengguna', Auth::id())
                            ->firstOrFail();
        
        $bookmark->delete();

        return redirect()->back();
    }
}
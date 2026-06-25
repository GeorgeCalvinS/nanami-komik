<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chapter;
use App\Models\Komik; // Panggil model Komik

class KomikController extends Controller
{
    // 1. Halaman Home (Menampilkan Komik Rekomendasi saja)
    public function index() {
        // Ambil 6 komik secara acak atau berdasarkan kriteria tertentu untuk rekomendasi
        $rekomendasi = Komik::inRandomOrder()->take(6)->get(); 
        
        return view('home', compact('rekomendasi'));
    }

    // 2. Halaman Browse (Menampilkan semua komik)
    public function browse() {
        $semuaKomik = Komik::all(); // Tarik semua data komik
        
        return view('browse', compact('semuaKomik'));
    }

    // 3. Halaman My Library
    public function library() {
        // Nanti ini akan difilter berdasarkan Bookmark user yang sedang login
        // Untuk sekarang kita tampilkan view-nya dulu
        return view('library');
    }

    public function show(Komik $komik)
    {
        $komik->load(['chapters' => function ($query) {
            $query->orderBy('nomor_chapter');
        }]);

        return view('komik.show', compact('komik'));
    }

    public function showChapter(Chapter $chapter)
    {
        $chapter->load('pages', 'komik');

        return view('chapters.show', compact('chapter'));
    }
}
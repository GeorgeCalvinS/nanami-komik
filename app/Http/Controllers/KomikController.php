<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chapter;
use App\Models\Komik;

class KomikController extends Controller
{
    // 1. Halaman Home
    public function index()
    {
        $rekomendasi = Komik::withCount('likes')
                            ->with('ratings')
                            ->inRandomOrder()
                            ->take(6)
                            ->get();

        $topKomik = Komik::withCount('likes')
                         ->with('ratings')
                         ->get()
                         ->sortByDesc(fn($k) => $k->rating_rata)
                         ->take(5)
                         ->values();

        return view('home', compact('rekomendasi', 'topKomik'));
    }

    // 2. Halaman Browse
    public function browse()
    {
        $semuaKomik = Komik::withCount('likes')
                           ->with('ratings')
                           ->latest()
                           ->get();

        $topKomik = Komik::withCount('likes')
                         ->with('ratings')
                         ->get()
                         ->sortByDesc(fn($k) => $k->rating_rata)
                         ->take(5)
                         ->values();

        return view('browse', compact('semuaKomik', 'topKomik'));
    }

    // 3. Halaman Library
    public function library()
    {
        return view('library');
    }

    // 4. Detail Komik
    public function show(Komik $komik)
    {
        $komik->load([
            'chapters' => fn($q) => $q->orderBy('nomor_chapter'),
            'ratings',
            'likes',
            'komentar.user',
        ]);

        return view('komik.show', compact('komik'));
    }

    // 5. Baca Chapter
    public function showChapter(Chapter $chapter)
    {
        $chapter->load('pages', 'komik');

        return view('chapters.show', compact('chapter'));
    }
}
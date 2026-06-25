<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use App\Models\Komik;
use App\Models\Pengguna;
use App\Models\RiwayatBaca;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard', [
            'userCount' => Pengguna::count(),
            'komikCount' => Komik::count(),
            'bookmarkCount' => Bookmark::count(),
            'historyCount' => RiwayatBaca::count(),
            'recentUsers' => Pengguna::orderByDesc('created_at')->limit(5)->get(),
            'recentKomik' => Komik::orderByDesc('created_at')->limit(5)->get(),
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PenggunaController extends Controller
{
    public function index()
    {
        $pengguna = Pengguna::all();
        return view('pengguna.index', compact('pengguna'));
    }

    public function create()
    {
        return view('pengguna.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_user' => 'required|string|max:255|unique:pengguna',
            'email_user' => 'required|email|unique:pengguna',
            'password' => 'required|string|min:8',
            'role_user' => 'required|integer',
        ]);

        Pengguna::create([
            'nama_user' => $request->nama_user,
            'email_user' => $request->email_user,
            'password' => Hash::make($request->password), 
            'role_user' => $request->role_user,
        ]);

        return redirect()->route('pengguna.index');
    }

    public function edit($id)
    {
        $pengguna = Pengguna::findOrFail($id);
        return view('pengguna.edit', compact('pengguna'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_user' => 'required|string|max:255',
            'email_user' => 'required|email',
            'role_user' => 'required|integer',
        ]);

        $pengguna = Pengguna::findOrFail($id);
        
        $dataUpdate = [
            'nama_user' => $request->nama_user,
            'email_user' => $request->email_user,
            'role_user' => $request->role_user,
        ];

        if ($request->filled('password')) {
            $dataUpdate['password'] = Hash::make($request->password);
        }

        $pengguna->update($dataUpdate);

        return redirect()->route('pengguna.index');
    }

    public function destroy($id)
    {
        $pengguna = Pengguna::findOrFail($id);
        $pengguna->delete();

        return redirect()->route('pengguna.index');
    }
}
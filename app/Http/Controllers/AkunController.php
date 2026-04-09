<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use Illuminate\Http\Request;

class AkunController extends Controller
{
    // tampil data
    public function index()
    {
        $akun = Akun::all();
        return view('admin.akun.index', compact('akun'));
    }

    // halaman tambah
    public function create()
    {
        return view('admin.akun.create');
    }

    // simpan data
   public function store(Request $request)
{
    // 1. Validasi
    $request->validate([
        'nama_akun' => 'required|string|max:255',
        'kategori_game' => 'required',
        'harga' => 'required|numeric',
        'status' => 'required',
        'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    // 2. Olah Foto
    $nama_foto = null;
    if ($request->hasFile('foto')) {
        $nama_foto = $request->file('foto')->store('akun-images', 'public');
    }

    // 3. Simpan ke Database
    // Ganti 'Akun' dengan nama Model Anda
    Akun::create([
        'nama_akun' => $request->nama_akun,
        'kategori_game' => $request->kategori_game,
        'harga' => $request->harga,
        'status' => $request->status,
        'deskripsi' => $request->deskripsi,
        'foto' => $nama_foto,
    ]);

    // 4. Kembali ke halaman yang sama dengan pesan sukses
    return redirect()->back()->with('success', 'Akun baru berhasil ditambahkan ke stok!');
}
}
<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * Halaman Dashboard Admin
     */
    public function index()
    {
        $totalAkun    = Akun::count();
        $totalTerjual = Akun::where('status', 'sold')->count();
        $totalUser    = User::where('role', '!=', 'admin')->count();
        $recentAkuns  = Akun::latest()->take(5)->get();

        return view('admin.admin', compact(
            'totalAkun',
            'totalTerjual',
            'totalUser',
            'recentAkuns'
        ));
    }

    /**
     * Form Edit Akun
     */
    public function edit($id)
    {
        $akun = Akun::findOrFail($id);
        return view('admin.akun.edit', compact('akun'));
    }

    /**
     * Update Data Akun
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_akun'     => 'required|string|max:255',
            'kategori_game' => 'required|string|max:255',
            'harga'         => 'required|numeric|min:0',
            'status'        => 'required|in:ready,sold,pending',
            'deskripsi'     => 'nullable|string',
            'foto'          => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $akun = Akun::findOrFail($id);

        // Ganti foto jika ada upload baru
        if ($request->hasFile('foto')) {
            if ($akun->foto) {
                Storage::disk('public')->delete($akun->foto);
            }
            $akun->foto = $request->file('foto')->store('akun', 'public');
        }

        $akun->nama_akun     = $request->nama_akun;
        $akun->kategori_game = $request->kategori_game;
        $akun->harga         = $request->harga;
        $akun->status        = $request->status;
        $akun->deskripsi     = $request->deskripsi;
        $akun->save();

        return redirect()->route('admin.akun.index')
                         ->with('success', 'Data akun berhasil diperbarui!');
    }

    /**
     * Hapus Akun
     */
    public function destroy($id)
    {
        $akun = Akun::findOrFail($id);

        if ($akun->foto) {
            Storage::disk('public')->delete($akun->foto);
        }

        $akun->delete();

        return redirect()->back()
                         ->with('success', 'Akun berhasil dihapus.');
    }
}
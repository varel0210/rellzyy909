<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Menampilkan daftar user
     */
    public function index()
    {
        $users = User::where('role', '!=', 'admin')->get(); // Mengambil user non-admin
        return view('admin.akun.kelola_user', compact('users'));
    }

    /**
     * Menghapus user
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'User berhasil dihapus.');
    }

    /**
     * Memberikan diskon kepada user
     * (Pastikan Anda sudah memiliki kolom 'discount' di tabel users)
     */
    public function giveDiscount(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'discount_percent' => 'required|numeric|min:0|max:100',
        ]);

        // 2. Cari User dan Update Diskonnya
        $user = User::findOrFail($request->user_id);
        
        // Simpan nilai diskon ke kolom 'discount' di database
        // Jika kolom belum ada, Anda perlu membuat migrasi untuk menambahkannya
        $user->discount = $request->discount_percent; 
        $user->save();

        return redirect()->back()->with('success', "Diskon {$request->discount_percent}% berhasil diberikan kepada {$user->name}.");
    }
}
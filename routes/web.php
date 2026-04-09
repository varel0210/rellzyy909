<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Akun;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AkunController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

/**
 * Route Beranda dengan Fitur Filter Kategori
 */
Route::get('/', function (Request $request) {
    $query = Akun::query();

    // Logika Filter: Jika ada parameter ?kategori= di URL
    if ($request->has('kategori') && $request->kategori != '') {
        $query->where('kategori_game', $request->kategori);
    }

    $akun = $query->latest()->get();
    
    // Ambil daftar kategori unik untuk ditampilkan di tombol filter
    $categories = Akun::select('kategori_game')->distinct()->pluck('kategori_game');

    return view('welcome', compact('akun', 'categories'));
})->name('home');

/**
 * Route Detail Produk
 */
Route::get('/akun/{id}', function ($id) {
    $akun = Akun::findOrFail($id);
    return view('detail', compact('akun'));
})->name('akun.detail');


/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginPost']);
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'registerPost']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


/*
|--------------------------------------------------------------------------
| Protected Routes (Auth Required)
|--------------------------------------------------------------------------
| Semua rute di bawah ini hanya bisa diakses jika user sudah login.
*/

Route::middleware(['auth'])->group(function () {
    
    // Dashboard Admin Utama
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');

    // Manajemen Stok Akun (CRUD Produk)
    Route::prefix('admin/akun')->group(function () {
        Route::get('/index', [AkunController::class, 'index'])->name('admin.akun.index');
        Route::get('/create', [AkunController::class, 'create'])->name('admin.akun.create');
        Route::post('/store', [AkunController::class, 'store'])->name('admin.akun.store');
        Route::get('/{id}/edit', [AdminController::class, 'edit'])->name('admin.akun.edit');
        Route::put('/{id}', [AdminController::class, 'update'])->name('admin.akun.update');
        Route::delete('/{id}', [AdminController::class, 'destroy'])->name('admin.akun.destroy');
    });

    // Manajemen User (Kelola Pelanggan/Admin)
    Route::get('/admin/kelola-user', [UserController::class, 'index'])->name('admin.akun.kelola_user');
    Route::delete('/admin/users/{id}', [UserController::class, 'destroy'])->name('admin.user.destroy');
    Route::post('/admin/user/give-discount', [UserController::class, 'giveDiscount'])->name('admin.user.give_discount');
    
    // Profile User (Opsi tambahan jika diperlukan)
    Route::get('/profile', function() {
        return view('profile'); // Pastikan file resources/views/profile.blade.php ada
    })->name('profile');
});
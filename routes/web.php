<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Agenda;

// Route lama (welcome page original)
Route::get('/welcome', function () {
    $semua_agenda = Agenda::all();
    return view('welcome', compact('semua_agenda'));
})->name('welcome');

Route::post('/simpan', function (Request $request) {
    Agenda::create([
        'nama_kegiatan' => $request->kegiatan,
        'tanggal' => $request->tgl
    ]);
    return back();
});

// ========================================
// FocusDay Application Routes
// ========================================

// Home Page - Halaman Beranda (Today's tasks)
Route::get('/', function (Request $request) {
    // Sederhana: jika belum login (session user tidak ada), arahkan ke halaman login
    if (!$request->session()->has('user')) {
        return redirect()->route('login');
    }

    return view('home');
})->name('home');

// Calendar Page - Halaman Kalender (Monthly view)
Route::get('/calendar', function () {
    return view('calendar');
})->name('calendar');

// All Tasks Page - Semua Tugas
Route::get('/tasks', function () {
    return view('tasks.all');
})->name('tasks.all');

// Categories Page - Kategori
Route::get('/categories', function () {
    return view('categories');
})->name('categories');

// Settings Page - Pengaturan
Route::get('/settings', function () {
    return view('settings');
})->name('settings');

// Login Page - Halaman Login
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Login Submit - Proses autentikasi sederhana berbasis tabel user
Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'username' => ['required', 'string'],
        'password' => ['required', 'string'],
    ]);

    // Ambil user berdasarkan username
    $user = DB::table('user')->where('username', $credentials['username'])->first();

    // Dalam setup saat ini password disimpan plain text (misalnya "tes")
    // Jadi kita bandingkan langsung. Jika nanti memakai hash, logika ini perlu diubah.
    if (!$user || $user->password !== $credentials['password']) {
        return back()
            ->withErrors(['login' => 'Username atau password tidak sesuai.'])
            ->withInput($request->only('username'));
    }

    // Simpan user ke session
    $request->session()->put('user', [
        'id'       => $user->id ?? null,
        'username' => $user->username ?? null,
        'email'    => $user->email ?? null,
    ]);

    // Arahkan ke halaman utama
    return redirect()->route('home');
})->name('login.submit');

// Register Page - Halaman Registrasi
Route::get('/register', function () {
    return view('auth.register');
})->name('register');
<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Agenda;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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

    $login = $credentials['username'];
    $user = User::query()
        ->where('email', $login)
        ->orWhere('name', $login)
        ->first();

    if (!$user || !Hash::check($credentials['password'], $user->password)) {
        return back()
            ->withErrors(['login' => 'Username atau password tidak sesuai.'])
            ->withInput($request->only('username'));
    }

    // Simpan user ke session
    $request->session()->put('user', [
        'id'    => $user->id,
        'name'  => $user->name,
        'email' => $user->email,
    ]);

    // Arahkan ke halaman utama
    return redirect()->route('home');
})->name('login.submit');

// Register Page - Halaman Registrasi
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', function (Request $request) {
    $validated = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
    ], [
        'password.confirmed' => 'Konfirmasi password tidak sesuai.',
    ]);

    User::create($validated);

    return redirect()->route('login')->with('success', 'Akun berhasil dibuat. Silakan masuk.');
})->name('register.store');
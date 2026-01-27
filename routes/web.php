<?php

use Illuminate\Support\Facades\Route;
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
Route::get('/', function () {
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
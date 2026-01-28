<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Agenda;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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

    $sessionUser = $request->session()->get('user');
    $userId = $sessionUser['id'] ?? null;

    $todayTasks = collect();
    $upcomingTasks = collect();
    $categories = collect();

    if ($userId) {
        $todayDate = Carbon::today()->toDateString();

        // Ambil rencana untuk hari ini (join ke kategori untuk dapat nama_kategori)
        $todayTasks = DB::table('rencana')
            ->leftJoin('kategori', 'rencana.kategori_id', '=', 'kategori.kategori_id')
            ->where('rencana.user_id', $userId)
            ->whereDate('rencana.tanggal', $todayDate)
            ->orderBy('rencana.tanggal')
            ->select(
                'rencana.rencana_id as id',
                'rencana.judul_tugas',
                'rencana.waktu',
                'rencana.tanggal',
                'rencana.status',
                'kategori.nama_kategori'
            )
            ->get();

        // Ambil rencana mendatang (setelah hari ini)
        $upcomingTasks = DB::table('rencana')
            ->leftJoin('kategori', 'rencana.kategori_id', '=', 'kategori.kategori_id')
            ->where('rencana.user_id', $userId)
            ->whereDate('rencana.tanggal', '>', $todayDate)
            ->orderBy('rencana.tanggal')
            ->limit(20)
            ->select(
                'rencana.rencana_id as id',
                'rencana.judul_tugas',
                'rencana.waktu',
                'rencana.tanggal',
                'rencana.status',
                'kategori.nama_kategori'
            )
            ->get();

        // Ambil daftar kategori milik user ini
        $categories = DB::table('kategori')
            ->where('user_id', $userId)
            ->orderBy('nama_kategori')
            ->get();
    }

    return view('home', [
        'todayTasks' => $todayTasks,
        'upcomingTasks' => $upcomingTasks,
        'categories' => $categories,
    ]);
})->name('home');

// Calendar Page - Halaman Kalender (Monthly view)
Route::get('/calendar', function () {
    return view('calendar');
})->name('calendar');

// All Tasks Page - Semua Tugas
Route::get('/tasks', function () {
    return view('tasks.all');
})->name('tasks.all');

// Simpan rencana baru dari modal Tambah Rencana
Route::post('/rencana', function (Request $request) {
    $sessionUser = $request->session()->get('user');
    $userId = $sessionUser['id'] ?? null;

    if (!$userId) {
        return response()->json(['message' => 'Unauthenticated'], 401);
    }

    $data = $request->validate([
        'judul_tugas' => ['required', 'string'],
        'kategori_id' => ['nullable', 'integer'],
        'tanggal'     => ['required', 'date'],
        'waktu'       => ['nullable', 'string'],
        'catatan'     => ['nullable', 'string'],
    ]);

    DB::table('rencana')->insert([
        'judul_tugas' => $data['judul_tugas'],
        'kategori_id' => $data['kategori_id'] ?? null,
        'tanggal'     => $data['tanggal'],
        'waktu'       => $data['waktu'] ?? null,
        'catatan'     => $data['catatan'] ?? null,
        'user_id'     => $userId,
    ]);

    return response()->json(['success' => true]);
})->name('rencana.store');

// Update status rencana (selesai / null)
Route::patch('/rencana/{id}/status', function (Request $request, $id) {
    $sessionUser = $request->session()->get('user');
    $userId = $sessionUser['id'] ?? null;

    if (!$userId) {
        return response()->json(['message' => 'Unauthenticated'], 401);
    }

    $status = $request->input('status');
    if ($status !== null && $status !== 'selesai') {
        return response()->json(['message' => 'Status tidak valid'], 422);
    }

    DB::table('rencana')
        ->where('rencana_id', $id)
        ->where('user_id', $userId)
        ->update(['status' => $status]);

    return response()->json(['success' => true]);
})->name('rencana.updateStatus');

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
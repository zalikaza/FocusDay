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
Route::get('/calendar', function (Request $request) {
    if (!$request->session()->has('user')) {
        return redirect()->route('login');
    }

    $sessionUser = $request->session()->get('user');
    $userId = $sessionUser['id'] ?? null;

    $plans = collect();
    $categories = collect();

    if ($userId) {
        $plans = DB::table('rencana')
            ->leftJoin('kategori', 'rencana.kategori_id', '=', 'kategori.kategori_id')
            ->where('rencana.user_id', $userId)
            ->orderBy('rencana.tanggal')
            ->orderBy('rencana.waktu')
            ->select(
                'rencana.rencana_id as id',
                'rencana.judul_tugas',
                'rencana.tanggal',
                'rencana.waktu',
                'rencana.status',
                'rencana.catatan',
                'rencana.kategori_id',
                'kategori.nama_kategori',
                'kategori.warna'
            )
            ->get();

        $categories = DB::table('kategori')
            ->where('user_id', $userId)
            ->orderBy('nama_kategori')
            ->get();
    }

    // Hitung statistik bulan ini berdasarkan data rencana
    $today = Carbon::today();
    $currentMonth = $today->month;
    $currentYear = $today->year;

    $monthPlans = $plans->filter(function ($plan) use ($currentMonth, $currentYear) {
        if (!$plan->tanggal) return false;
        $date = Carbon::parse($plan->tanggal);
        return $date->month === $currentMonth && $date->year === $currentYear;
    });

    $totalTasks = $monthPlans->count();
    $completedTasks = $monthPlans->where('status', 'selesai')->count();
    $overdueTasks = $monthPlans->filter(function ($plan) use ($today) {
        if (!$plan->tanggal) return false;
        $date = Carbon::parse($plan->tanggal);
        return $plan->status !== 'selesai' && $date->lt($today);
    })->count();

    return view('calendar', [
        'plans' => $plans,
        'categories' => $categories,
        'totalTasks' => $totalTasks,
        'completedTasks' => $completedTasks,
        'overdueTasks' => $overdueTasks,
    ]);
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

// Update status rencana (selesai / null) ketika user mencentang / undo tugas
Route::post('/rencana/status', function (Request $request) {
    $sessionUser = $request->session()->get('user');
    $userId = $sessionUser['id'] ?? null;

    if (!$userId) {
        return response()->json(['message' => 'Unauthenticated'], 401);
    }

    $data = $request->validate([
        'id' => ['required', 'integer'],
        'status' => ['nullable', 'string'],
    ]);

    DB::table('rencana')
        ->where('rencana_id', $data['id'])
        ->where('user_id', $userId)
        ->update([
            'status' => $data['status'],
        ]);

    return response()->json(['success' => true]);
})->name('rencana.updateStatus');

// Tambah kategori baru (dipakai dari modal di Beranda)
Route::post('/kategori', function (Request $request) {
    $sessionUser = $request->session()->get('user');
    $userId = $sessionUser['id'] ?? null;

    if (!$userId) {
        return response()->json(['message' => 'Unauthenticated'], 401);
    }

    $data = $request->validate([
        'nama_kategori' => ['required', 'string', 'max:255'],
        'warna' => ['nullable', 'string', 'max:50'],
    ]);

    $kategoriId = DB::table('kategori')->insertGetId([
        'nama_kategori' => $data['nama_kategori'],
        'warna' => $data['warna'] ?? null,
        'user_id' => $userId,
    ]);

    return response()->json([
        'success' => true,
        'category' => [
            'kategori_id' => $kategoriId,
            'nama_kategori' => $data['nama_kategori'],
            'warna' => $data['warna'] ?? null,
        ],
    ]);
})->name('categories.store');

// Categories Page - Kategori
Route::get('/categories', function () {
    return view('categories');
})->name('categories');

// Settings Page - Pengaturan
Route::get('/settings', function (Request $request) {
    $sessionUser = $request->session()->get('user');
    $userId = $sessionUser['id'] ?? null;

    $user = $userId ? User::find($userId) : null;

    return view('settings', [
        'user' => $user,
    ]);
})->name('settings');

// Update profil (nama & email)
Route::post('/settings/profile', function (Request $request) {
    $sessionUser = $request->session()->get('user');
    $userId = $sessionUser['id'] ?? null;

    if (!$userId) {
        return redirect()->route('login');
    }

    $user = User::findOrFail($userId);

    $validated = $request->validate([
        'name'  => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
    ]);

    $user->update($validated);

    // Update juga data di session agar header menampilkan nilai terbaru
    $request->session()->put('user', [
        'id'    => $user->id,
        'name'  => $user->name,
        'email' => $user->email,
    ]);

    return back()->with('success', 'Profil berhasil diperbarui.');
})->name('settings.profile.update');

// Update password
Route::post('/settings/password', function (Request $request) {
    $sessionUser = $request->session()->get('user');
    $userId = $sessionUser['id'] ?? null;

    if (!$userId) {
        return redirect()->route('login');
    }

    $user = User::findOrFail($userId);

    $validated = $request->validate([
        'current_password' => ['required'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
    ]);

    if (!Hash::check($validated['current_password'], $user->password)) {
        return back()->withErrors(['current_password' => 'Password lama tidak sesuai.']);
    }

    $user->password = Hash::make($validated['password']);
    $user->save();

    return back()->with('success', 'Password berhasil diperbarui.');
})->name('settings.password.update');

// Update preferensi tampilan (tema & hari awal minggu)
Route::post('/settings/preferences', function (Request $request) {
    $sessionUser = $request->session()->get('user');
    $userId = $sessionUser['id'] ?? null;

    if (!$userId) {
        return redirect()->route('login');
    }

    $user = User::findOrFail($userId);

    $data = $request->validate([
        'theme' => ['nullable', 'in:light,dark'],
        'week_start' => ['nullable', 'in:0,1'],
    ]);

    // Jika kolom-kolom ini ada di tabel users, update nilainya
    $update = [];
    if (array_key_exists('theme', $data)) {
        $update['theme'] = $data['theme'];
    }
    if (array_key_exists('week_start', $data)) {
        $update['week_start'] = (int) $data['week_start'];
    }

    if (!empty($update)) {
        $user->fill($update);
        $user->save();
    }

    return back()->with('success', 'Preferensi tampilan berhasil disimpan.');
})->name('settings.preferences.update');

// Logout - hapus session user
Route::post('/logout', function (Request $request) {
    $request->session()->forget('user');
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('login');
})->name('logout');

// Login Page - Halaman Login
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Login Submit - autentikasi langsung ke tabel `user` (user_id, username, email, password plain text)
Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'username' => ['required', 'string'],
        'password' => ['required', 'string'],
    ]);

    $login = $credentials['username'];

    // Pakai Query Builder ke tabel `user` (bukan model User bawaan Laravel)
    $user = DB::table('user')
        ->where('username', $login)
        ->orWhere('email', $login)
        ->first();

    if (!$user || $user->password !== $credentials['password']) {
        return back()
            ->withErrors(['login' => 'Username atau password tidak sesuai.'])
            ->withInput($request->only('username'));
    }

    // Simpan ke session persis dari kolom di tabel `user`
    $request->session()->put('user', [
        'id'    => $user->user_id,
        'name'  => $user->username,
        'email' => $user->email,
    ]);

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
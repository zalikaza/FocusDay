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
                'rencana.catatan',
                'kategori.nama_kategori',
                'kategori.warna'
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
                'rencana.catatan',
                'kategori.nama_kategori',
                'kategori.warna'
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
Route::get('/tasks', function (Request $request) {
    if (!$request->session()->has('user')) {
        return redirect()->route('login');
    }

    $sessionUser = $request->session()->get('user');
    $userId = $sessionUser['id'] ?? null;

    if (!$userId) {
        return redirect()->route('login');
    }

    $tasks = DB::table('rencana')
        ->leftJoin('kategori', 'rencana.kategori_id', '=', 'kategori.kategori_id')
        ->where('rencana.user_id', $userId)
        ->orderBy('rencana.tanggal')
        ->orderBy('rencana.waktu')
        ->select(
            'rencana.rencana_id as id',
            'rencana.judul_tugas',
            'rencana.waktu',
            'rencana.tanggal',
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

    return view('tasks.all', [
        'tasks' => $tasks,
        'categories' => $categories,
    ]);
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

// Toggle status rencana (untuk checkbox di modal kalender)
Route::post('/rencana/{id}/toggle-status', function (Request $request, $id) {
    $sessionUser = $request->session()->get('user');
    $userId = $sessionUser['id'] ?? null;

    if (!$userId) {
        return response()->json(['message' => 'Unauthenticated'], 401);
    }

    $data = $request->validate([
        'status' => ['nullable', 'string'],
    ]);

    $updated = DB::table('rencana')
        ->where('rencana_id', (int) $id)
        ->where('user_id', $userId)
        ->update([
            'status' => $data['status'],
        ]);

    if (!$updated) {
        return response()->json(['message' => 'Not Found'], 404);
    }

    return response()->json(['success' => true]);
})->name('rencana.toggleStatus');

// Update rencana (dipakai dari modal edit di Kalender)
Route::post('/rencana/{id}', function (Request $request, $id) {
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

    $updated = DB::table('rencana')
        ->where('rencana_id', (int) $id)
        ->where('user_id', $userId)
        ->update([
            'judul_tugas' => $data['judul_tugas'],
            'kategori_id' => $data['kategori_id'] ?? null,
            'tanggal'     => $data['tanggal'],
            'waktu'       => $data['waktu'] ?? null,
            'catatan'     => $data['catatan'] ?? null,
        ]);

    if (!$updated) {
        return response()->json(['message' => 'Not Found'], 404);
    }

    return response()->json(['success' => true]);
})->where('id', '[0-9]+')->name('rencana.update');

// Hapus rencana
Route::delete('/rencana/{id}/delete', function (Request $request, $id) {
    $sessionUser = $request->session()->get('user');
    $userId = $sessionUser['id'] ?? null;

    if (!$userId) {
        return response()->json(['message' => 'Unauthenticated'], 401);
    }

    $deleted = DB::table('rencana')
        ->where('rencana_id', (int) $id)
        ->where('user_id', $userId)
        ->delete();

    if (!$deleted) {
        return response()->json(['message' => 'Not Found or not authorized'], 404);
    }

    return response()->json(['success' => true]);
})->name('rencana.delete');

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
Route::get('/categories', function (Request $request) {
    $sessionUser = $request->session()->get('user');
    $userId = $sessionUser['id'] ?? null;

    if (!$userId) {
        return redirect()->route('login');
    }

    $tasks = DB::table('rencana')
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

    return view('categories', [
        'tasks' => $tasks,
        'categories' => $categories,
    ]);
})->name('categories');

// Settings Page - Pengaturan
Route::get('/settings', function (Request $request) {
    $sessionUser = $request->session()->get('user');
    $userId = $sessionUser['id'] ?? null;

    if (!$userId) {
        return redirect()->route('login');
    }

    $user = $userId
        ? DB::table('user')->where('user_id', (int) $userId)->first()
        : null;

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

    $user = DB::table('user')->where('user_id', (int) $userId)->first();
    if (!$user) {
        return redirect()->route('login');
    }

    $validated = $request->validate([
        'username'  => ['required', 'string', 'max:255', 'unique:user,username,' . (int) $userId . ',user_id'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:user,email,' . (int) $userId . ',user_id'],
    ]);

    DB::table('user')
        ->where('user_id', (int) $userId)
        ->update([
            'username' => $validated['username'],
            'email' => $validated['email'],
        ]);

    // Update juga data di session agar header menampilkan nilai terbaru
    $request->session()->put('user', [
        'id'    => (int) $userId,
        'name'  => $validated['username'],
        'email' => $validated['email'],
        'username' => $validated['username'],
    ]);

    return back()->with('success', 'Profil berhasil diperbarui.');
})->name('settings.profile.update');

Route::post('/settings/profile/photo', function (Request $request) {
    $sessionUser = $request->session()->get('user');
    $userId = $sessionUser['id'] ?? null;

    if (!$userId) {
        return redirect()->route('login');
    }

    $user = DB::table('user')->where('user_id', (int) $userId)->first();
    if (!$user) {
        return redirect()->route('login');
    }

    $data = $request->validate([
        'profile_photo' => ['required', 'image', 'max:2048'],
    ]);

    $file = $data['profile_photo'];
    $dir = public_path('uploads/profile');
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }

    $ext = $file->getClientOriginalExtension() ?: 'jpg';
    $filename = 'user_' . (int) $userId . '_' . uniqid() . '.' . $ext;
    $file->move($dir, $filename);

    $relativePath = 'uploads/profile/' . $filename;

    DB::table('user')
        ->where('user_id', (int) $userId)
        ->update([
            'profile' => $relativePath,
        ]);

    return back()->with('success', 'Foto profil berhasil diperbarui.');
})->name('settings.profile.photo.update');

Route::post('/settings/profile/photo/delete', function (Request $request) {
    $sessionUser = $request->session()->get('user');
    $userId = $sessionUser['id'] ?? null;

    if (!$userId) {
        return redirect()->route('login');
    }

    $user = DB::table('user')->where('user_id', (int) $userId)->first();
    if (!$user) {
        return redirect()->route('login');
    }

    $profilePath = (string)($user->profile ?? '');

    if (!empty($profilePath) && str_starts_with($profilePath, 'uploads/profile/')) {
        $fullPath = public_path($profilePath);
        if (is_file($fullPath)) {
            @unlink($fullPath);
        }
    }

    DB::table('user')
        ->where('user_id', (int) $userId)
        ->update([
            'profile' => null,
        ]);

    return back()->with('success', 'Foto profil berhasil dihapus.');
})->name('settings.profile.photo.delete');

// Update password (plain text)
Route::post('/settings/password', function (Request $request) {
    $sessionUser = $request->session()->get('user');
    $userId = $sessionUser['id'] ?? null;

    if (!$userId) {
        return redirect()->route('login');
    }

    $user = DB::table('user')->where('user_id', (int) $userId)->first();
    if (!$user) {
        return redirect()->route('login');
    }

    $storedPassword = (string) ($user->password ?? '');

    $validated = $request->validate([
        'current_password' => ['required'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
    ]);

    $currentOk = hash_equals($storedPassword, (string) $validated['current_password']);

    if (!$currentOk) {
        return back()->withErrors(['current_password' => 'Password lama tidak sesuai.']);
    }

    DB::table('user')
        ->where('user_id', (int) $userId)
        ->update([
            'password' => (string) $validated['password'],
        ]);

    return back()->with('success', 'Password berhasil diperbarui.');
})->name('settings.password.update');

Route::post('/settings/password/check-current', function (Request $request) {
    $sessionUser = $request->session()->get('user');
    $userId = $sessionUser['id'] ?? null;

    if (!$userId) {
        return response()->json(['ok' => false], 401);
    }

    $validated = $request->validate([
        'current_password' => ['required', 'string'],
    ]);

    $user = DB::table('user')->where('user_id', (int) $userId)->first();
    if (!$user) {
        return response()->json(['ok' => false], 401);
    }

    $storedPassword = (string) ($user->password ?? '');
    $currentOk = hash_equals($storedPassword, (string) $validated['current_password']);

    return response()->json(['ok' => (bool) $currentOk]);
})->name('settings.password.check');

// Update preferensi tampilan (tema & hari awal minggu)
Route::post('/settings/preferences', function (Request $request) {
    $sessionUser = $request->session()->get('user');
    $userId = $sessionUser['id'] ?? null;

    if (!$userId) {
        return redirect()->route('login');
    }

    // Table `user` saat ini belum menyimpan preferensi (theme/week_start) secara permanen.
    // Tetap validasi agar request rapi, tapi tidak mengubah DB.
    $request->validate([
        'theme' => ['nullable', 'in:light,dark'],
        'week_start' => ['nullable', 'in:0,1'],
    ]);

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

// Login Submit - autentikasi langsung ke tabel `user` (password plain text)
Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'username' => ['required', 'string'],
        'password' => ['required', 'string'],
    ]);

    $login = $credentials['username'];

    $user = DB::table('user')
        ->where('username', $login)
        ->orWhere('email', $login)
        ->first();

    if (!$user) {
        return back()
            ->withErrors(['login' => 'Username atau password tidak sesuai.'])
            ->withInput($request->only('username'));
    }

    $storedPassword = (string) ($user->password ?? '');
    $passwordOk = hash_equals($storedPassword, (string) $credentials['password']);

    if (!$passwordOk) {
        return back()
            ->withErrors(['login' => 'Username atau password tidak sesuai.'])
            ->withInput($request->only('username'));
    }

    $request->session()->put('user', [
        'id'    => $user->user_id,
        'name'  => $user->username,
        'username' => $user->username,
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
        'username' => ['required', 'string', 'max:255', 'unique:user,username'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:user,email'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
    ], [
        'password.confirmed' => 'Konfirmasi password tidak sesuai.',
    ]);

    DB::table('user')->insert([
        'username' => $validated['username'],
        'email' => $validated['email'],
        'password' => (string) $validated['password'],
    ]);

    return redirect()->route('login')->with('success', 'Akun berhasil dibuat. Silakan masuk.');
})->name('register.store');
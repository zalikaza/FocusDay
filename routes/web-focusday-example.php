<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - FocusDay Application
|--------------------------------------------------------------------------
|
| Add these routes to your routes/web.php file to use the FocusDay views
|
*/

// Home Page - Today's tasks
Route::get('/', function () {
    return view('home');
})->name('home');

// Calendar Page - Monthly view
Route::get('/calendar', function () {
    return view('calendar');
})->name('calendar');

// All Tasks Page
Route::get('/tasks', function () {
    return view('tasks.all');
})->name('tasks.all');

// Categories Page
Route::get('/categories', function () {
    return view('categories');
})->name('categories');

// Settings Page
Route::get('/settings', function () {
    return view('settings');
})->name('settings');

/*
|--------------------------------------------------------------------------
| Next Steps: Add Controllers
|--------------------------------------------------------------------------
|
| For a production application, replace these closures with proper controllers:
|
| Route::get('/', [HomeController::class, 'index'])->name('home');
| Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar');
| Route::resource('tasks', TaskController::class);
| Route::resource('categories', CategoryController::class);
|
*/

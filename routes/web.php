<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Halaman Welcome
Route::get('/', function () {
    // Pass recent concerts to the welcome view so the event list can render.
    $concerts = \App\Models\Concert::orderBy('date', 'desc')->limit(8)->get();

    return view('welcome', compact('concerts'));
});

// Halaman Concerts
use App\Http\Controllers\ConcertController;
Route::get('/concerts', [ConcertController::class, 'index'])->name('concerts.index');
Route::get('/concerts/search', [ConcertController::class, 'search'])->name('concerts.search');
// Concert detail
Route::get('/concerts/{concert}', [ConcertController::class, 'show'])->name('concerts.show');

// ============================
// DASHBOARD MULTI-ROLE
// ============================
Route::middleware(['auth'])->group(function () {

    // Route dashboard untuk Admin
    Route::get('/admin/dashboard', function () {
        return view('dashboard.admin');
    })->name('admin.dashboard');

    // Route dashboard untuk EO
    Route::get('/eo/dashboard', function () {
        return view('dashboard.eo');
    })->name('eo.dashboard');

    // Route dashboard untuk User biasa
    Route::get('/user/dashboard', function () {
        return view('dashboard.user');
    })->name('user.dashboard');

    // Riwayat pesanan (history) untuk user yang sudah login
    Route::get('/history', function () {
        return view('history');
    })->name('history');
});

// ============================
// PROFILE
// ============================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

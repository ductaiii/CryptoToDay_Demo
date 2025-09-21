
<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;


Route::get('/', function () {
    return redirect()->route('login');
});

// Auth routes (không prefix, không middleware auth)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// User routes (chỉ cho user thường)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    // API lấy/cập nhật watchlist
    Route::get('/api/watchlist', [\App\Http\Controllers\DashboardController::class, 'getWatchlist']);
    Route::post('/api/watchlist', [\App\Http\Controllers\DashboardController::class, 'updateWatchlist']);
});

// Admin user CRUD (chỉ cho admin, kiểm tra quyền trong controller)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function() { return redirect()->route('admin.users.index'); });
    Route::resource('users', \App\Http\Controllers\AdminUserController::class);
    Route::get('users/{id}/watchlist', [\App\Http\Controllers\AdminUserController::class, 'getUserWatchlist']);
});

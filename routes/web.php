<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\FotograferController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckRole;
use App\Models\Fotografer;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
})->name('landing_page');

Route::get('/select-role', function () {
    return Inertia::render('Auth/SelectRole');
})->name('select_role');

Route::get('/explore', function() {
    return Inertia::render('Auth/Explore');
})->name('explore');

// Logout
Route::middleware(['auth'])->group(function(){
    Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});


// Route User

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user-dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/order', [UserController::class, 'order'])->name('user.order');
    Route::get('/user-profile', [UserController::class, 'index'])->name('user.profile');
    Route::get('/user-profile/edit', [UserController::class, 'create'])->name('user.edit.profile');
    Route::patch('user-profile/edit/{id}', [UserController::class, 'update'])->name('user.update');
});

// Route Fotografer

Route::middleware(['auth', 'role:fotografer'])->group(function () {
    Route::get('/dashboard', [FotograferController::class, 'index'])->name('fotografer.dashboard');
    Route::get('/profile', [FotograferController::class, 'show'])->name('fotografer.profile');
    Route::get('/profile/edit', [FotograferController::class, 'editProfile'])->name('fotografer.edit.profile');
    Route::get('/information/edit', [FotograferController::class, 'editInformation'])->name('fotografer.edit.information');
    Route::patch('/profile/edit/{id}', [FotograferController::class, 'updateProfile'])->name('fotografer.update.profile');
    Route::post('/information/update', [FotograferController::class, 'updateInformation'])->name('fotografer.update.information');
    Route::post('/information', [FotograferController::class, 'store'])->name('fotografer.store.information');
});



require __DIR__.'/auth.php';

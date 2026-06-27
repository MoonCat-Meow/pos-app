<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PosController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'role:Admin|Kasir'])->group(function () {

    Route::get('/pos', [PosController::class, 'index'])
        ->name('pos.index');

    Route::post('/pos/add/{id}', [PosController::class, 'addToCart'])
        ->name('pos.add');

    Route::post('/pos/update/{id}', [PosController::class, 'updateCart'])
        ->name('pos.update');

    Route::delete('/pos/remove/{id}', [PosController::class, 'removeCart'])
        ->name('pos.remove');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {

    // =========================
    // BREEZE PROFILE ROUTES
    // =========================
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);

    // =========================
    // POS DASHBOARD
    // =========================
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    
    // LOGOUT (tambahan kita)
    Route::post('/logout', function () {
        Auth::logout();
        return redirect('/login');
    })->name('logout');

});

require __DIR__.'/auth.php';

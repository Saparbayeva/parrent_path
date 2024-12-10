<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\ContactController;

Route::get('/', function () {
    return view('welcome');
});



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('categories', CategoryController::class);

    Route::resource('resources', ResourceController::class);
    Route::get('resources/{id}/approve', [ ResourceController::class, 'approve' ])->name('approve');
    Route::get('resources/{id}/reject', [ ResourceController::class, 'reject' ])->name('reject');


    Route::resource('users', UserController::class);
    // Foydalanuvchilar ro'yxati uchun route
    Route::get('/users', [UserController::class, 'index'])->name('users.index');

    // Foydalanuvchini ko‘rish uchun route
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');

    // Foydalanuvchini o‘chirish uchun route
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');


Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');
Route::post('/contacts', [ContactController::class, 'store'])->name('contacts.store');
Route::get('/contacts/{id}/edit', [ContactController::class, 'edit'])->name('contacts.edit');
Route::put('/contacts/{id}', [ContactController::class, 'update'])->name('contacts.update');
Route::delete('/contacts/{id}', [ContactController::class, 'destroy'])->name('contacts.destroy');

});


require __DIR__.'/auth.php';

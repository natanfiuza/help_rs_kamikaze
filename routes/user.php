<?php
use Illuminate\Support\Facades\Route;

Route::prefix('/user')->group(function () {

    Route::get('profile', [App\Http\Controllers\UserController::class, 'profile'])->name('user.profile');
    Route::get('create', [App\Http\Controllers\UserController::class, 'create'])->name('user.create');
    Route::post('store', [App\Http\Controllers\UserController::class, 'store'])->name('user.store');
    Route::get('edit/{id}', [App\Http\Controllers\UserController::class, 'edit'])->name('user.edit');
    Route::put('update/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');

});

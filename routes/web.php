<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Auth::routes();

Route::prefix('/user')->group(function () {

    Route::get('', [App\Http\Controllers\UserController::class, 'index'])->name('user.index');
    Route::get('index', [App\Http\Controllers\UserController::class, 'index'])->name('user.index');
    Route::get('profile', [App\Http\Controllers\UserController::class, 'profile'])->name('user.profile');
    Route::get('create', [App\Http\Controllers\UserController::class, 'create'])->name('user.create');
    Route::post('store', [App\Http\Controllers\UserController::class, 'store'])->name('user.store');
    Route::get('edit/{id}', [App\Http\Controllers\UserController::class, 'edit'])->name('user.edit');
    Route::put('update/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');

});

Route::prefix('/consulta')->group(function () {

    Route::get('', [App\Http\Controllers\ConsultaController::class, 'index'])->name('consulta.index');
    Route::get('index', [App\Http\Controllers\ConsultaController::class, 'index'])->name('consulta.index');
    Route::get('create', [App\Http\Controllers\ConsultaController::class, 'create'])->name('consulta.create');
    Route::post('store', [App\Http\Controllers\ConsultaController::class, 'store'])->name('consulta.store');
    Route::get('edit/{id}', [App\Http\Controllers\ConsultaController::class, 'edit'])->name('consulta.edit');
    Route::put('update/{id}', [App\Http\Controllers\ConsultaController::class, 'update'])->name('consulta.update');

});


Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');

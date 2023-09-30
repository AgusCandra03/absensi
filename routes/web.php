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
    return view('auth/login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/edit-profile', [App\Http\Controllers\Auth\RegisterController::class, 'editProfile'])->name('editProfile');
Route::post('/edit-profile', [App\Http\Controllers\Auth\RegisterController::class, 'updateProfile'])->name('update-profile');
Route::resource('/employees', App\Http\Controllers\Auth\RegisterController::class);

route::get('/spatie', [App\Http\Controllers\Auth\RegisterController::class, 'spatie']);

Route::get('/api/employees', [App\Http\Controllers\Auth\RegisterController::class, 'api']);
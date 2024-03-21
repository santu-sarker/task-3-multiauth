<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
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
// Custom login route
Route::view('/login', 'auth.login')->middleware(['guest:web', 'guest:admin'])->name('login');
Route::post('/login_check', [LoginController::class, 'user_login'])->name('login.check');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::view('/unapproved', 'unapproved')->name('verification.required');

Route::middleware(['auth:web', 'is_verified'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('user.home');
});

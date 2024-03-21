<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| admin Routes
|--------------------------------------------------------------------------
|
*/

Route::middleware('auth:admin')->prefix('admin')->group(function () {
    Route::get('/home', [AdminController::class, 'index'])->name('admin.home');
    Route::get('/user/add/{id}', [AdminController::class, 'approve_user']);
    Route::get('/user/delete/{id}', [AdminController::class, 'decline_user']);
});

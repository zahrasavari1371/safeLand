<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'loginForm'])->middleware('web');
Route::post('/send-code', [AuthController::class, 'sendLoginCode'])->name('send.code')->middleware('web');
Route::post('/login', [AuthController::class, 'login'])->name('login')->middleware('web');


Route::middleware('auth')->group(function () {
    Route::get('logout', [AuthController::class, 'logout'])
        ->name('logout');
});

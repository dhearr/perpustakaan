<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserRegistrationController;

Route::get('/', function () {
    return view('home');
});


Route::get('/register', [UserRegistrationController::class, 'create'])->name('register');
Route::post('/register', [UserRegistrationController::class, 'store'])->name('register.store');


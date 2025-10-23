<?php

use App\Http\Controllers\Auth\Register;
use App\Http\Controllers\ChirpController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ChirpController::class, 'index']);
Route::post('/chirps', [ChirpController::class, 'store']);
Route::get('/chirps/{chirp}/edit', [ChirpController::class, 'edit']);
Route::put('/chirps/{chirp}', [ChirpController::class, 'update']);
Route::delete('/chirps/{chirp}', [ChirpController::class, 'destroy']);

//REGISTER ROUTES
Route::view('/register', 'auth.register')
->middleware('guest')
->name('register');

Route::post('/register', Register::class)
->middleware('guest');

Route::view('/login', 'auth.login');


/*Route::get('/sign-in', function () {
    return view('sign-in');
})->name('signin');


 Route::get('signup', function () {
    return view('auth.signup');
})->name('signup');
*/
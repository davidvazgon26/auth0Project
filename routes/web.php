<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthDemoController;

// ******** rutas

Route::post('/loginLocal', [AuthDemoController::class, 'loginLocal'])->name('loginLocal');
// del formulario de registro
Route::post('/register', [AuthDemoController::class, 'register'])->name('register');

// ********  Vistas

Route::get('/', function () {
    return view('welcome');
});


Route::get('/demo', function () {
    return response('este es demo');
});

Route::get('/private', function () {
    return response('welcome!! You are logged in.');
}) -> middleware('auth');

Route::get('/main', function () {
    return view('main');
}) -> middleware('auth');


Route::get('/register', function () {
    return view('registration-form');
}) -> name('register');

Route::get('/sesionLocal', function () {
    return view('sesionLocal');
}) -> name('sesionLocal');
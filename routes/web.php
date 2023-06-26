<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('TheHome');
})->name('home');
Route::get('/sign-in', function () {
    return Inertia::render('TheSignIn');
})->name('sign-in');
Route::get('/sign-up', function () {
    return Inertia::render('TheSignUp');
})->name('sign-up');

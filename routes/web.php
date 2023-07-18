<?php

use App\Http\Controllers\AuthGoogleController;
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

Route::get('/', fn () => Inertia::render('TheHome'))->name('home');
Route::get('/members', fn () => Inertia::render('TheMembers'))->name('members');
Route::get('/events', fn () => Inertia::render('TheEvents'))->name('events');
Route::get('/portfolio', fn () => Inertia::render('ThePortfolio'))->name('portfolio');
Route::get('/post', fn () => Inertia::render('ThePost'))->name('post');
Route::get('/sign-in', fn () => Inertia::render('TheSignIn'))->name('sign-in');
Route::get('/sign-up', fn () => Inertia::render('TheSignUp'))->name('sign-up');
Route::get('/password-reset', fn () => Inertia::render('ThePasswordReset'))->name('password-reset');
Route::get('/dashboard', fn() => Inertia::render('Dashboard/TheDashboard'))->name('dashboard');

Route::get('/auth/google/redirect', [AuthGoogleController::class, "redirect"])->name('auth.google.redirect');
Route::get('/auth/google/callback',[AuthGoogleController::class, "callback"])->name('auth.google.callback');

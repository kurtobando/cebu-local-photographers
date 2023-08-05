<?php

use App\Http\Controllers\AuthGoogleController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\SignInController;
use App\Http\Controllers\SignOutController;
use App\Http\Controllers\SignUpController;
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

Route::get('/password-reset', [PasswordResetController::class, "index"])->name('password-reset');
Route::post('/password-reset', [PasswordResetController::class, "store"])->name('password-reset.store');

Route::get('/sign-in', [SignInController::class, 'index'])->name('sign-in');
Route::post('/sign-in', [SignInController::class, 'store'])->name('sign-in.store');

Route::get('/sign-up', [SignUpController::class, 'index'])->name('sign-up');
Route::post('/sign-up', [SignUpController::class, 'store'])->name('sign-up.store');

// socialite
Route::get('/auth/google/redirect', [AuthGoogleController::class, "redirect"])->name('auth.google.redirect');
Route::get('/auth/google/callback', [AuthGoogleController::class, "callback"])->name('auth.google.callback');

// TODO!, add middleware to protect dashboard routes
Route::prefix('dashboard')
    ->middleware(['auth'])
    ->group(function () {
        Route::get('/', [DashboardController::class, "index"])->name('dashboard');
        Route::post('/sign-out', [SignOutController::class, "store"])->name('dashboard.sign-out');
    });

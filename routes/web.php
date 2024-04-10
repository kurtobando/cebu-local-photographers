<?php

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\DashboardPhotosController;
use App\Http\Controllers\Dashboard\DashboardPhotosGalleryController;
use App\Http\Controllers\Dashboard\DashboardProfileController;
use App\Http\Controllers\Dashboard\DashboardProfileImageController;
use App\Http\Controllers\Dashboard\DashboardUserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PasswordConfirmationController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\PostCommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostLikeController;
use App\Http\Controllers\PostSaveForLaterController;
use App\Http\Controllers\PostUnlikeController;
use App\Http\Controllers\SignInController;
use App\Http\Controllers\SignOutController;
use App\Http\Controllers\SignUpController;
use App\Http\Controllers\SignUpGoogleController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/events', fn () => Inertia::render('TheEvents'))->name('events');
Route::get('/portfolio', fn () => Inertia::render('ThePortfolio'))->name('portfolio');

Route::get('/post/{id}', [PostController::class, 'index'])->name('post');
Route::post('/post/{id}/like', [PostLikeController::class, 'store'])->name('post.like.store');
Route::post('/post/{id}/unlike', [PostUnlikeController::class, 'store'])->name('post.unlike.store');
Route::post('/post/{id}/save-for-later', [PostSaveForLaterController::class, 'store'])->name('post.save-for-later.store');
Route::post('/post/{id}/comment', [PostCommentController::class, 'store'])->name('post.comment.store');

Route::controller(MemberController::class)
    ->prefix('members')
    ->group(function () {
        Route::get('/', "index")->name('members');
        Route::get('/{user}', "show")->name('members.show');
    });

Route::controller(PasswordResetController::class)
    ->prefix('password-reset')
    ->group(function () {
        Route::get('/', 'index')->name('password-reset');
        Route::post('/', 'store')->name('password-reset.store');
    });

Route::controller(PasswordConfirmationController::class)
    ->prefix('password-confirmation')
    ->group(function () {
        Route::get('/', 'index')->name('password-confirmation');
        Route::post('/', 'update')->name('password-confirmation.update');
    });

Route::controller(SignInController::class)
    ->prefix('sign-in')
    ->group(function () {
        Route::get('/', 'index')->name('sign-in');
        Route::post('/', 'store')->name('sign-in.store');
    });

Route::controller(SignUpController::class)
    ->prefix('sign-up')
    ->group(function () {
        Route::get('/', 'index')->name('sign-up');
        Route::post('/', 'store')->name('sign-up.store');
    });

Route::controller(SignUpGoogleController::class)
    ->prefix('auth/google')
    ->group(function () {
        Route::get('/redirect', "redirect")->name('auth.google.redirect');
        Route::get('/callback', "callback")->name('auth.google.callback');
    });

Route::prefix('dashboard')
    ->middleware(['auth'])
    ->group(function () {
        Route::get('/', [DashboardController::class, "index"])->name('dashboard');
        Route::post('/sign-out', [SignOutController::class, "store"])->name('dashboard.sign-out');

        Route::get('/profile', [DashboardProfileController::class, "index"])->name('dashboard.profile');
        Route::patch('/profile', [DashboardProfileController::class, "update"])->name('dashboard.profile.update');
        Route::post('/profile-image', [DashboardProfileImageController::class, "store"])->name('dashboard.profile-image.store');

        Route::get('/photos', [DashboardPhotosController::class, "create"])->name('dashboard.photos.create');
        Route::post('/photos', [DashboardPhotosController::class, "store"])->name('dashboard.photos.store');
        Route::get('/photos/{post}', [DashboardPhotosController::class, "show"])->name('dashboard.photos.show');
        Route::get('/photos/{post}/edit', [DashboardPhotosController::class, "edit"])->name('dashboard.photos.edit');
        Route::patch('/photos', [DashboardPhotosController::class, "update"])->name('dashboard.photos.update');

        Route::get('/photos-gallery', [DashboardPhotosGalleryController::class, "index"])->name('dashboard.photos-gallery.index');

        Route::get('/users', [DashboardUserController::class, "index"])->name('dashboard.users');
    });

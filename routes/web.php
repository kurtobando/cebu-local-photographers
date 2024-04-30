<?php

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\DashboardPhotosController;
use App\Http\Controllers\Dashboard\DashboardPhotosGalleryController;
use App\Http\Controllers\Dashboard\DashboardProfileController;
use App\Http\Controllers\Dashboard\DashboardProfileImageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\MemberFollowController;
use App\Http\Controllers\PasswordConfirmationController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\PostCommentController;
use App\Http\Controllers\PostCommentLikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostLikeController;
use App\Http\Controllers\PostSaveForLaterController;
use App\Http\Controllers\SignInController;
use App\Http\Controllers\SignOutController;
use App\Http\Controllers\SignUpController;
use App\Http\Controllers\SignUpGoogleController;
use Illuminate\Support\Facades\Route;

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

//Route::get('/events', fn () => Inertia::render('TheEvents'))->name('events');

Route::prefix('post')
    ->group(function () {
        Route::get('/{id}', [PostController::class, 'index'])->name('post');

        Route::controller(PostSaveForLaterController::class)
            ->prefix('/{id}/save-for-later')
            ->group(function () {
                Route::post('/', 'store')->name('post.save-for-later.store');
            });

        Route::controller(PostLikeController::class)
            ->prefix('/{id}/like')
            ->group(function () {
                Route::post('/', 'store')->name('post.like.store');
                Route::delete('/', 'destroy')->name('post.like.destroy');
            });

        Route::controller(PostCommentController::class)
            ->prefix('/{id}/comment')
            ->group(function () {
                Route::post('/', "store")->name('post.comment.store');
            });

        Route::controller(PostCommentLikeController::class)
            ->prefix('/{id}/comment/{commentId}/like')
            ->group(function () {
                Route::post('/', 'store')->name('post.comment.like.store');
                Route::delete('/', 'destroy')->name('post.comment.like.destroy');
            });
    });

Route::controller(MemberController::class)
    ->prefix('members')
    ->group(function () {
        Route::get('/', "index")->name('members');
        Route::get('/{user}', "show")->name('members.show');
    });

Route::controller(MemberFollowController::class)
    ->prefix('members/{user}/follow')
    ->group(function () {
        Route::post('/', "store")->name('members.follow.store');
        Route::delete('/', "destroy")->name('members.follow.destroy');
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

        Route::controller(DashboardProfileController::class)
            ->prefix('profile')
            ->group(function () {
                Route::get('/', 'index')->name('dashboard.profile.index');
                Route::patch('/', 'update')->name('dashboard.profile.update');
            });

        Route::controller(DashboardProfileImageController::class)
            ->prefix('profile-image')
            ->group(function () {
                Route::post('/', 'store')->name('dashboard.profile-image.store');
            });

        Route::controller(DashboardPhotosController::class)
            ->prefix('photos')
            ->group(function () {
                Route::get('/', 'create')->name('dashboard.photos.create');
                Route::post('/', 'store')->name('dashboard.photos.store');
                Route::get('/{post}', 'show')->name('dashboard.photos.show');
                Route::get('/{post}/edit', 'edit')->name('dashboard.photos.edit');
                Route::patch('/', 'update')->name('dashboard.photos.update');
            });

        Route::controller(DashboardPhotosGalleryController::class)
            ->prefix('photos-gallery')
            ->group(function () {
                Route::get('/', 'index')->name('dashboard.photos-gallery.index');
            });
    });

<?php

use App\Http\Controllers\Protected\Dashboard\DashboardController;
use App\Http\Controllers\Protected\Dashboard\Message\DashboardMessageArchiveController;
use App\Http\Controllers\Protected\Dashboard\Message\DashboardMessageController;
use App\Http\Controllers\Protected\Dashboard\Message\DashboardMessageThreadController;
use App\Http\Controllers\Protected\Dashboard\Notification\DashboardNotificationController;
use App\Http\Controllers\Protected\Dashboard\Photo\DashboardPhotosController;
use App\Http\Controllers\Protected\Dashboard\Photo\DashboardPhotosGalleryController;
use App\Http\Controllers\Protected\Dashboard\Profile\DashboardProfileController;
use App\Http\Controllers\Protected\Dashboard\Profile\DashboardProfileImageController;
use App\Http\Controllers\Public\Auth\AuthPasswordConfirmationController;
use App\Http\Controllers\Public\Auth\AuthPasswordResetController;
use App\Http\Controllers\Public\Auth\AuthSignInController;
use App\Http\Controllers\Public\Auth\AuthSignOutController;
use App\Http\Controllers\Public\Auth\AuthSignUpController;
use App\Http\Controllers\Public\Auth\AuthSignUpGoogleController;
use App\Http\Controllers\Public\Home\HomeController;
use App\Http\Controllers\Public\Member\MemberController;
use App\Http\Controllers\Public\Member\MemberFollowController;
use App\Http\Controllers\Public\Message\MessageHireMeController;
use App\Http\Controllers\Public\Post\PostCommentController;
use App\Http\Controllers\Public\Post\PostCommentLikeController;
use App\Http\Controllers\Public\Post\PostController;
use App\Http\Controllers\Public\Post\PostLikeController;
use App\Http\Controllers\Public\Post\PostSaveForLaterController;
use App\Http\Controllers\Public\Privacy\PrivacyController;
use App\Http\Controllers\Public\TermsOfService\TermOfServiceController;
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
                Route::post('/', 'store')->name('post.comment.store');
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
        Route::get('/', 'index')->name('members');
        Route::get('/{user}', 'show')->name('members.show');
    });

Route::controller(MemberFollowController::class)
    ->prefix('members/{user}/follow')
    ->group(function () {
        Route::post('/', 'store')->name('members.follow.store');
        Route::delete('/', 'destroy')->name('members.follow.destroy');
    });

Route::prefix('auth')
    ->group(function () {
        Route::controller(AuthPasswordResetController::class)
            ->prefix('password-reset')
            ->group(function () {
                Route::get('/', 'index')->name('password-reset');
                Route::post('/', 'store')->name('password-reset.store');
            });

        Route::controller(AuthPasswordConfirmationController::class)
            ->prefix('password-confirmation')
            ->group(function () {
                Route::get('/', 'index')->name('password-confirmation');
                Route::post('/', 'update')->name('password-confirmation.update');
            });

        Route::controller(AuthSignInController::class)
            ->prefix('sign-in')
            ->group(function () {
                Route::get('/', 'index')->name('sign-in');
                Route::post('/', 'store')->name('sign-in.store');
            });

        Route::controller(AuthSignUpController::class)
            ->prefix('sign-up')
            ->group(function () {
                Route::get('/', 'index')->name('sign-up');
                Route::post('/', 'store')->name('sign-up.store');
            });
    });

Route::controller(AuthSignUpGoogleController::class)
    ->prefix('auth/google')
    ->group(function () {
        Route::get('/redirect', 'redirect')->name('auth.google.redirect');
        Route::get('/callback', 'callback')->name('auth.google.callback');
    });

Route::controller(MessageHireMeController::class)
    ->prefix('message')
    ->group(function () {
        Route::post('/', 'store')->name('hire-me.message.store');
    });

Route::controller(PrivacyController::class)
    ->prefix('privacy')
    ->group(function () {
        Route::get('/', 'index')->name('privacy');
    });

Route::controller(TermOfServiceController::class)
    ->prefix('term-of-service')
    ->group(function () {
        Route::get('/', 'index')->name('term-of-service');
    });

Route::prefix('dashboard')
    ->middleware(['auth'])
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::post('/sign-out', [AuthSignOutController::class, 'store'])->name('dashboard.sign-out');

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

        Route::controller(DashboardMessageController::class)
            ->prefix('message')
            ->group(function () {
                Route::get('/', 'index')->name('dashboard.message.index');
                Route::get('/{uuid}', 'show')->name('dashboard.message.show');
            });

        Route::controller(DashboardMessageThreadController::class)
            ->prefix('message-thread')
            ->group(function () {
                Route::post('/{uuid}', 'store')->name('dashboard.message-thread.store');
            });

        Route::controller(DashboardMessageArchiveController::class)
            ->prefix('message-archive')
            ->group(function () {
                Route::patch('/{uuid}', 'update')->name('dashboard.message-archive.update');
            });

        Route::controller(DashboardNotificationController::class)
            ->prefix('notification')
            ->group(function () {
                Route::get('/', 'index')->name('dashboard.notification.index');
                Route::patch('/{uuid}', 'update')->name('dashboard.notification.update');
            });
    });

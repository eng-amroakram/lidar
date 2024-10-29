<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FrontendController;
use App\Livewire\Admin\Auth\ForgotPassword;
use App\Livewire\Admin\Auth\Login;
use App\Livewire\Admin\Auth\Register;
use App\Livewire\Admin\Home;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// GET Getting from server
// POST Sending to server

Route::controller(AuthController::class)
    ->as('auth.')
    ->prefix('auth')
    ->middleware(['web'])
    ->group(function () {

        Route::middleware('guest')
            ->group(function () {
                Route::get('register', Register::class)->name('register');
                Route::get('forgot_password/{email_phone?}', ForgotPassword::class)->name('forgot_password');

                // Route::get('password_recovery', 'password_recovery')->name('password_recovery');
                // Route::post('forget_password', 'forget_password')->name('forget_password');
                // Route::post('register_user', 'register_user')->name('register_user');
            });


        Route::post('login', 'login')->name('login');
        Route::post('verify_email', 'verify_email')->name('verify_email');
        Route::get('logout', 'logout')->name('logout');
    });

Route::controller(FrontendController::class)
    ->as('frontend.')
    ->group(function () {

        Route::middleware(['web'])->group(function () {
            Route::get('', Login::class)->name('index');
        });

        Route::middleware(['web', 'auth', 'otp'])->group(function () {
            Route::get('host', 'host')->name('host');
            Route::get('home', Home::class)->name('home');
            Route::get('invite', 'invite')->name('invite');
            Route::get('meetings', 'meetings')->name('meetings');
            Route::get('past_meetings', 'past_meetings')->name('past_meetings');
            Route::get('unauthorized_recording', 'unauthorized_recording')->name('unauthorized_recording');
        });
    });

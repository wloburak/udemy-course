<?php

use App\Http\Controllers\AccountController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
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

Route::get('/', [HomeController::class, 'home'])->name('home');

// Unauth group
Route::group(['before' => 'guest'], function() {

    // CSRF protection
    Route::group(['before' => 'csrf'], function() {

        // Create an account (POST)
        Route::post('/account/create', [AccountController::class, 'postCreate'] )->name('account-create-post');
        
    });

    // Create an accout 
    Route::get('/account/create', [AccountController::class, 'getCreate'] )->name('account-create');
    Route::get('/account/activate/{code}', [AccountController::class, 'getActivate'] )->name('account-activate');

    // Sign in 
    Route::get('/account/sign-in', [AccountController::class, 'getSignIn'] )->name('account-sign-in');
    Route::get('/account/sign-in', [AccountController::class, 'postSignIn'] )->name('account-sign-in-post');
});
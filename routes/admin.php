<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\LoginAdminController;
use App\Http\Controllers\Dashboard\Settings\SettingsController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
    |--------------------------------------------------------------------------
    | Admin Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register web routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | contains the "web" middleware group. Now create something great!
    |
*/

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {
        Route::group(['middleware' => 'guest:admin', 'prefix' => 'admin'], function () {

            Route::get('/login', [LoginAdminController::class, 'getlogin'])->name('admin.login');
            Route::post('/login', [LoginAdminController::class, 'postLogin'])->name('admin.post.login');
        });

        Route::group(['middleware' => 'auth:admin', 'prefix' => 'admin'], function () {

            Route::get('/', [AdminController::class, 'index'])->name('admin.index');

            Route::group(['prefix' => 'settings'], function () {

                Route::get('shippings-methods/{type}', [SettingsController::class, 'editShippingsMethods'])
                    ->name('get.shippings.method');

                Route::put('shippings-methods/{id}', [SettingsController::class, 'updateShippingsMethods'])
                    ->name('update.shippings.method');
            });
        });
    }
);
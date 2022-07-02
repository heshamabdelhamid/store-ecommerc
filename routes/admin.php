<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\Admin\AdminController;
use App\Http\Controllers\Dashboard\Admin\AdminProfile;
use App\Http\Controllers\Dashboard\Authentication\LoginAdminController;
use App\Http\Controllers\Dashboard\Authentication\LogoutAdminController;
use App\Http\Controllers\Dashboard\Categories\MainCategoryController;
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

        ////////////////////// Route Admin Login ///////////////////////
        Route::group(['middleware' => 'guest:admin', 'prefix' => 'admin'], function () {
            Route::get('/login', [LoginAdminController::class, 'getlogin'])->name('admin.login');
            Route::post('/login', [LoginAdminController::class, 'postLogin'])->name('admin.post.login');
        });

        ///////////////////////Route Group For Authntcation Only ///////////////////
        Route::group(['middleware' => 'auth:admin', 'prefix' => 'admin'], function () {

            /////////////////// Route admin index &&& Route admin Logout ///////////////////
            Route::get('/', [AdminController::class, 'index'])->name('admin.index');
            Route::get('logout', [LogoutAdminController::class, 'logout'])->name('admin.logout');

            ////////////////////// Route Settings /////////////////////////
            Route::group(['prefix' => 'settings'], function () {
                Route::get('shippings-methods/{type}', [SettingsController::class, 'editShippingsMethods'])->name('get.shippings.method');
                Route::put('shippings-methods/{id}', [SettingsController::class, 'updateShippingsMethods'])->name('update.shippings.method');
            });

            ///////////////////// Route Admin Profile ///////////////////////
            Route::group(['prefix' => 'profile'], function () {
                Route::get('update', [AdminProfile::class, 'getAdminProfile'])->name('get.admin.profile');
                Route::put('update', [AdminProfile::class, 'updateAdminProfile'])->name('update.admin.profile');
            });

            /////////////////////// Route Main_Categories && Sub_Categories ///////////////////////
            Route::group(['prefix' => 'main-categories'], function () {
                Route::get('/', [MainCategoryController::class, 'index'])->name('admin.main-category.index');
                Route::get('create', [MainCategoryController::class, 'create'])->name('admin.main-category.create');
                Route::post('store', [MainCategoryController::class, 'store'])->name('admin.main-category.store');
                Route::get('edit/{id}', [MainCategoryController::class, 'edit'])->name('admin.main-category.edit');
                Route::PUT('update', [MainCategoryController::class, 'update'])->name('admin.main-category.update');
                Route::DELETE('delete', [MainCategoryController::class, 'destroy'])->name('admin.main-category.delete');
            });
        });
    }
);

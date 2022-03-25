<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\LoginAdminController;


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

// prefix admin in RouteServesProvider

Route::group(['middleware' => 'guest:admin'], function () {

    Route::get('/login', [LoginAdminController::class, 'getlogin'])->name('admin.login');
    Route::post('/login', [LoginAdminController::class, 'postLogin'])->name('admin.post.login');
});

Route::group(['middleware' => 'auth:admin'], function () {

    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
});

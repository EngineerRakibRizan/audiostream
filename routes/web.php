<?php

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

Route::get('/', [App\Http\Controllers\Home\HomeController::class, 'index'])->name('index');

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "auth" middleware group. Now create something great!
|
*/

Auth::routes(['verify' => true]);
Route::get('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "user" middleware group. Now create something great!
|
*/

// user protected routes
Route::group(['middleware' => ['auth', 'user'], 'prefix' => 'user'], function () {
    Route::get('dashboard', [App\Http\Controllers\User\UserController::class, 'dashboard'])->name('user.dashboard');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/

// admin protected routes
Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin'], function () {
    Route::get('dashboard', [App\Http\Controllers\Admin\AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('artists', [App\Http\Controllers\Admin\AdminController::class, 'artists']);
    Route::get('create-artist', [App\Http\Controllers\Admin\AdminController::class, 'create_artist']);
    Route::post('store-artist', [App\Http\Controllers\Admin\AdminController::class, 'store_artist'])->name('store.artist');
    Route::post('update-artist', [App\Http\Controllers\Admin\AdminController::class, 'update_artist'])->name('update.artist');
    Route::get('edit-artist/{id}', [App\Http\Controllers\Admin\AdminController::class, 'edit_artist']);
    Route::get('delete-artist/{id}', [App\Http\Controllers\Admin\AdminController::class, 'delete_artist']);
    Route::get('create-artist', [App\Http\Controllers\Admin\AdminController::class, 'create_artist']);
});

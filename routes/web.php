<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/**
 * 自作管理画面
 */

Route::get('/admin/login', function () {
    return view('adminLogin');
})->middleware('guest:admin');

Route::post('/admin/login', [App\Http\Controllers\Admin\LoginController::class, 'adminLogin'])->name('admin.login');

Route::get('/admin/logout', [App\Http\Controllers\Admin\LoginController::class, 'adminLogout'])->name('admin.logout');

Route::get('/admin/dashboard', function () {
    return view('adminDashboard');
})->middleware('auth:admin');

Route::get('/admin/register', [App\Http\Controllers\Admin\RegisterController::class, 'adminRegisterForm'])->middleware('auth:admin');

Route::post('/admin/register', [App\Http\Controllers\Admin\RegisterController::class, 'adminRegister'])->middleware('auth:admin')->name('admin.register');

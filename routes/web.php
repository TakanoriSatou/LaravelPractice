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

/**
 * ユーザー管理画面
 */

Route::get('/admin/dashboard/user',[App\Http\Controllers\User\UserController::class, 'index'])->middleware('auth:admin')->name('admin.dashboard.user');

Route::get('/admin/dashboard/user/add',[App\Http\Controllers\User\UserController::class, 'add'])->middleware('auth:admin');
Route::post('/admin/dashboard/user/create',[App\Http\Controllers\User\UserController::class, 'create'])->middleware('auth:admin');

Route::get('/admin/dashboard/user/edit/{user}', [App\Http\Controllers\User\UserController::class, 'edit'])->middleware('auth:admin');
Route::post('/admin/dashboard/user/update/{user}', [App\Http\Controllers\User\UserController::class, 'update'])->middleware('auth:admin');

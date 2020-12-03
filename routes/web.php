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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/admin/login', [App\Http\Controllers\AdminController::class, 'LoginView'])->name('admin.login');
Route::get('/admin/register', [App\Http\Controllers\AdminController::class, 'RegisterView'])->name('admin.register');
Route::post('/admin/register', [App\Http\Controllers\AdminController::class, 'Register']);
Route::post('/admin/login', [App\Http\Controllers\AdminController::class, 'Login']);
Route::post('/admin/logout', [App\Http\Controllers\AdminController::class, 'logout'])->name('admin.logout');
Route::get('/admin/profile',[App\Http\Controllers\AdminController::class, 'Profile'])->middleware('admin.auth:admin');
Route::get('/admin/forgot-password',[App\Http\Controllers\ForgetPasswordController::class, 'ForgetPassView'])->name('password.request');
Route::post('/admin/forgot-password',[App\Http\Controllers\ForgetPasswordController::class, 'SendResetLink'])->name('password.email');
Route::get('/admin/reset-password/{token}',[App\Http\Controllers\ResetPasswordController::class, 'showResetForm'])->name('admin.password.reset');
Route::post('/admin/reset-password',[App\Http\Controllers\ResetPasswordController::class, 'reset'])->name('password.update');
Route::post('/admin/email/verification/resend',[App\Http\Controllers\EmailVerifyController::class, 'resend'])->name('verification.resend');
Route::get('/admin/email/verify',[App\Http\Controllers\AdminController::class,'show'])->name('verification.notice');
Route::get('/admin/email/{id}/{hash}',[App\Http\Controllers\EmailVerifyController::class,'verify'])->name('verification.verify');



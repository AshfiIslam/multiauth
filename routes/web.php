<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;

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
Route::post('/userlogin',[LoginController::class,'loginUser'])->name('userlogin');
Route::get('/user-auth',[LoginController::class,'loginPage'])->name('user-auth');

Route::post('/adminlogin',[LoginController::class,'adminlogin'])->name('adminlogin');

// /admin/dashboard
// Route::post('/userlogin',[::class,'login'])->name('userlogin');

Route::get('accept/{id}', [HomeController::class, 'accept'])->name('accept');
Route::get('deny/{id}', [HomeController::class, 'deny'])->name('deny');


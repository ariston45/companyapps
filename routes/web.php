<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;


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

# routing for general
Auth::routes();
Route::get('/', [HomeController::class,'index'])->name('home.index');
Route::get('/home', [HomeController::class,'home'])->name('home');
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
#view
Route::get('user', [UserController::class,'viewDataUser'])->name('user');
Route::get('create-user', [UserController::class,'viewFormCreateUser'])->name('create-user');
Route::get('update-user/{iduser}', [UserController::class,'viewFormUpdateUser'])->name('create-user');
Route::get('seting-menu', [UserController::class,'viewDataUser'])->name('user');
#datatable source
Route::get('source-data-user', [UserController::class,'sourceDataUser'])->name('source-data-user');

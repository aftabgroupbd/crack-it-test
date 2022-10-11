<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\TrashController;
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

Route::get('/',[IndexController::class,'index'])->name('/');
Route::post('/login',[AuthController::class,'login'])->name('loginSubmit');
Route::get('/register',[AuthController::class,'register'])->name('register');
Route::post('/register',[AuthController::class,'registerSubmit'])->name('registerSubmit');

Route::middleware(['is_loggedin'])->group(function () {
    Route::post('/profile-update',[AuthController::class,'profile'])->name('profile');
    Route::get('/logout',[AuthController::class,'logout'])->name('logout');
    Route::resource('/contacts',ContactController::class);
    Route::get('/contacts/ajax/edit/{id}',[ContactController::class,'ajaxEdit'])->name('ajaxEdit');
    Route::get('/contacts/bookmark/{id}',[ContactController::class,'bookmark'])->name('bookmark');
    Route::get('/contacts/bookmark/remove/{id}',[ContactController::class,'bookmarkRemove'])->name('bookmarkRemove');
    Route::resource('/trashs',TrashController::class);
    Route::get('/trashs/restore/{id}',[TrashController::class,'restore'])->name('restore');
});

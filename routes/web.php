<?php

use App\Http\Controllers\homeController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\newsController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', [loginController::class, 'index'])->name('login');
Route::post('/login', [loginController::class, 'proses'])->name('login.proses');

Route::middleware(['auth'])->group(function(){
    Route::get('/home', [homeController::class, 'index'])->name('home');;
    Route::get('/news', [newsController::class, 'index'])->name('news');;
    Route::get('/news/add', [newsController::class, 'add'])->name('news.add');;
    Route::get('/news/edit/{id}', [newsController::class, 'edit'])->name('news.edit');
    Route::post('/news/store', [newsController::class, 'store'])->name('news.store');
    Route::post('/news/update', [newsController::class, 'update_data'])->name('news.update');
    Route::post('/news/delete', [newsController::class, 'delete'])->name('news.delete');

});


Route::get('/logout', [loginController::class, 'logout'])->name('logout');

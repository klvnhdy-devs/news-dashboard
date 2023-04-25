<?php

use App\Http\Controllers\Api\apiNews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::get('/news', [apiNews::class, 'index'])->name('news');
Route::get('/news/{id}', [apiNews::class, 'detail'])->name('news.detail');

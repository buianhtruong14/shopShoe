<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

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

//Frontend

Route::get('/', [HomeController::class, 'index'] );
Route::get('/trang-chu', [HomeController::class, 'index'] );

//Backend
Route::get('/admin',[AdminController::class, 'index']);
Route::get('/dashboard',[AdminController::class,'showDashBoard']);
Route::get('/logout',[AdminController::class,'logOut']);
Route::post('/admin-dashboard',[AdminController::class,'dashBoard']);
    

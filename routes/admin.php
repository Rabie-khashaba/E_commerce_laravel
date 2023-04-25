<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MainComtroller;
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

Route::group(['namespace' => 'Admin' ,'middleware' => 'auth:admin' ],function (){
    Route::get('/', [DashboardController::class , 'index'])->name('admin.dashboard');
});

Route::group(['namespace' => 'Admin', 'middleware' => 'guest:admin'] ,function (){
    Route::get('login' , [LoginController::class , 'adminLogin'])->name('get.admin.login');;
    Route::post('login' , [LoginController::class , 'checkAdminLogin'])->name('admin.login');
});




<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LanguagesController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\MainCategoryController;
use App\Http\Controllers\Admin\VendorController;
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

define('PAGINATION_COUNT' , 10);

Route::group(['namespace' => 'Admin' ,'middleware' => 'auth:admin' ],function (){
    Route::get('/', [DashboardController::class , 'index'])->name('admin.dashboard');

    ################## Begin Language Admins ################
    Route::group(['prefix' => 'languages'], function (){
        Route::get('/',[LanguagesController::class , 'index'])->name('admin.languages');

        Route::get('create',[LanguagesController::class , 'createLanguage'])->name('create.admin.languages');
        Route::post('save',[LanguagesController::class , 'saveLanguage'])->name('save.admin.languages');

        Route::get('delete_language/{language_id}',[LanguagesController::class , 'deleteLanguage'])->name('delete.admin.languages');
        Route::get('edit_language/{language_id}',[LanguagesController::class , 'editLanguages'])->name('edit.admin.languages');
        Route::post('update_language/{language_id}',[LanguagesController::class , 'saveUpdateLanguages'])->name('update.admin.languages');

    });
    ################## End Language Admins ################

    ################## Start Main Categories Admins ################

    Route::group(['prefix' => 'main_categories'], function (){
        Route::get('/',[MainCategoryController::class , 'index'])->name('admin.mainCategories');

        Route::get('create',[MainCategoryController::class , 'createMainCategory'])->name('create.admin.mainCategories');
        Route::post('save',[MainCategoryController::class , 'saveMainCategory'])->name('save.admin.mainCategories');

        Route::get('edit_main_categories/{id}',[MainCategoryController::class , 'editMainCategory'])->name('edit.admin.mainCategories');
        Route::post('update_main_categories/{id}',[MainCategoryController::class , 'saveUpdateMainCategory'])->name('update.admin.mainCategories');
        Route::get('delete_main_categories/{id}',[MainCategoryController::class , 'deleteMainCategory'])->name('delete.admin.mainCategories');
        Route::get('changeStatus/{id}',[MainCategoryController::class , 'changeStatus'])->name('status.admin.mainCategories');


    });
    ################## End Main Categories Admins ################



    ################### Start Main Vendors Admins ################

    Route::group(['prefix' => 'vendors'], function (){
        Route::get('/',[VendorController::class , 'index'])->name('admin.vendors');

        Route::get('create',[VendorController::class , 'createVendors'])->name('create.admin.vendors');
        Route::post('save',[VendorController::class , 'saveVendors'])->name('save.admin.vendors');

        Route::get('edit_vendors/{id}',[VendorController::class , 'editVendors'])->name('edit.admin.vendors');
        Route::post('update_vendors/{id}',[VendorController::class , 'saveUpdateVendors'])->name('update.admin.vendors');
        Route::get('delete_vendors/{id}',[VendorController::class , 'deleteVendors'])->name('delete.admin.vendors');

    });

    ################## End Main Vendors Admins ################

});

Route::group(['namespace' => 'Admin', 'middleware' => 'guest:admin'] ,function (){
    Route::get('login' , [LoginController::class , 'adminLogin'])->name('admin.login');;
    Route::post('login' , [LoginController::class , 'checkAdminLogin'])->name('admin.login');
});




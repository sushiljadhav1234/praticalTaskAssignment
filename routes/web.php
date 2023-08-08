<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

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

//----######################### A D M I N   S Y S T E M  ################################------//

//====================== CATEGORIES - SUB CATEGORIES CRUD SECTION ================//

Route::get('/admin/category/index', [CategoryController::class, 'indexCategory'])->name('index-category');
Route::get('/admin/category/create', [CategoryController::class, 'createCategory'])->name('create-category');
Route::POST('/admin/category/index', [CategoryController::class, 'storeCategory'])->name('store-category');
Route::get('/admin/category/create', [CategoryController::class, 'createCategory'])->name('createCategory');
Route::get('/admin/category/edit/{id}', [CategoryController::class, 'editCategory'])->name('edit-category');
Route::PUT('/admin/category/update/{id}',[CategoryController::class,'updateCategory'])->name('update-category');
Route::DELETE('/admin/category/delete/{id}', [CategoryController::class, 'deleteCategory'])->name('delete-category');

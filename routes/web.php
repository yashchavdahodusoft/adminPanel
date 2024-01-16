<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CodeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\SubCategoryController;
use Database\Factories\SubCategoryFactory;
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

Route::get('/', function () {
    return redirect()->route('dashboard');
});
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('login', [AuthController::class, 'loginProcess'])->name('login.process');
Route::middleware('auth:admin')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('tables', [DashboardController::class, 'tables'])->name('tables');
    Route::resource('category',CategoryController::class);
    Route::resource('sub-category',SubCategoryController::class);
    Route::get('sub-category/getSubCategoryByCategoryId/{category}',[SubCategoryController::class,'getSubCategoryByCategoryId'])->name('getSubCategoryByCatgoryId');
    Route::resource('post',PostController::class);
    Route::resource('slider',SliderController::class);
    Route::post('ckeditor/upload',[PostController::class,'uploadImageFormCkEditor'])->name('ckeditor.upload');
    Route::get('code-section',[PostController::class,'createCodeSection'])->name('create.code.section');
    Route::delete('code/{code}',[CodeController::class,'destroy'])->name('code.delete');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});

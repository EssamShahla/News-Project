<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SpecialtyController;
use App\Http\Controllers\SubCategory;
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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('cms/admin')->group(function() {
    Route::view('' , 'cms.parent');
    Route::view('/test' , 'cms.temp');
    Route::resource('/countries' , CountryController::class);
    Route::post('/countries_update/{id}' , [CountryController::class , 'update'])->name('countries_update');
    Route::resource('/cities' , CityController::class);
    Route::post('/cities_update/{id}' , [CityController::class , 'update'])->name('cities_update');
    Route::resource('/specialties' , SpecialtyController::class);
    Route::post('/specialties_update/{id}' , [SpecialtyController::class , 'update'])->name('specialties_update');
    Route::resource('/admins' , AdminController::class);
    Route::post('/admins_update/{id}' , [AdminController::class , 'update'])->name('admins_update');
    Route::resource('/authors' , AuthorController::class);
    Route::post('/authors_update/{id}' , [AuthorController::class , 'update'])->name('authors_update');

});


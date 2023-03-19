<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\SpecialtyController;
use App\Http\Controllers\UserAuthController;
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

// route for login actions
Route::prefix('cms/')->middleware('guest:admin,author')->group(function(){
    Route::get('{guard}/login' , [UserAuthController::class , 'showLogin'])->name('showLogin');
    Route::post('{guard}/login' , [UserAuthController::class , 'login']);
});

// route for logout actions
Route::prefix('cms/admin')->middleware('auth:admin,author')->group(function(){
    Route::get('/logout' , [UserAuthController::class , 'logout'])->name('logout');
});

Route::prefix('cms/admin')->middleware('auth:admin,author')->group(function() {
    // Route::view('' , 'cms.parent');
    Route::view('' , 'cms.home')->name('home');
    Route::view('/test' , 'cms.temp');
    // Country routes
    Route::resource('/countries' , CountryController::class);
    Route::post('/countries_update/{id}' , [CountryController::class , 'update'])->name('countries_update');
    // city routes
    Route::resource('/cities' , CityController::class);
    Route::post('/cities_update/{id}' , [CityController::class , 'update'])->name('cities_update');
    // Specialty routes
    Route::resource('/specialties' , SpecialtyController::class);
    Route::post('/specialties_update/{id}' , [SpecialtyController::class , 'update'])->name('specialties_update');
    // Admin routes
    Route::resource('/admins' , AdminController::class);
    Route::post('/admins_update/{id}' , [AdminController::class , 'update'])->name('admins_update');
    // Author routes
    Route::resource('/authors' , AuthorController::class);
    Route::post('/authors_update/{id}' , [AuthorController::class , 'update'])->name('authors_update');
    // Category routes
    Route::resource('/categories' , CategoryController::class);
    Route::post('/categories_update/{id}' , [CategoryController::class , 'update'])->name('categories_update');
    // new Idea in category table that delete all the table's elements
    Route::delete('/categories_deleteAll', [CategoryController::class , 'deleteAll'])->name('categories_deleteAll');
    // Articles routes
    Route::resource('/articles' , ArticleController::class);
    Route::post('/articles_update/{id}' , [ArticleController::class , 'update'])->name('articles_update');
    Route::get('index/articles/{id}' , [ArticleController::class , 'indexArticle'])->name('indexArticle');
    Route::get('create/articles/{id}' , [ArticleController::class , 'createArticle'])->name('createArticle');
});


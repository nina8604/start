<?php

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

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index')->name('home');


Route::resource('/products', 'ProductsController');
Route::resource('/categories', 'CategoryController')->only(['index', 'show']);
Route::get('/vue', 'VueController@index')->name('vue');


Auth::routes();

Route::prefix('admin')->middleware('auth')->name('admin.')->namespace('Admin')->group(function(){
    Route::resource('/categories', 'CategoryController');
    Route::resource('/products', 'ProductsController');
});


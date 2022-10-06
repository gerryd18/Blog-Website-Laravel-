<?php

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
    return view('home');    
});
Route::get('/information', function () {
    return 'This is information page';
});


Route::get('/information/all', 'App\Http\Controllers\PageController@allInfo')->name('getAllInformation');



//without grouping
Route::get('/category' , 'App\Http\Controllers\CategoryController@index')->middleware('RoleAdmin');

//with grouping
Route::group(['middleware' => 'RoleAdmin'],function(){

    // category routes
    // Route::get('/category' , 'App\Http\Controllers\CategoryController@index');
    Route::post('/category', 'App\Http\Controllers\CategoryController@store')->name('storeCategory');
    Route::get('/category{id}' , 'App\Http\Controllers\CategoryController@edit')->name('editCategory');
    Route::put('/category{id}', 'App\Http\Controllers\CategoryController@update')->name('updateCategory');
    Route::delete('/category{id}', 'App\Http\Controllers\CategoryController@destroy')->name('deleteCategory');

    //accept information
    Route::put('/information/accepted/{id}','App\Http\Controllers\InformationController@acceptInformation')->name('acceptInformation');
});

//  BLOG ROUTES
 Route::get('/information' , 'App\Http\Controllers\InformationController@index');
 Route::post('/information', 'App\Http\Controllers\InformationController@store')->name('storeInformation');
 Route::get('/information{id}' , 'App\Http\Controllers\InformationController@edit')->name('editInformation');
 Route::put('/information{id}', 'App\Http\Controllers\InformationController@update')->name('updateInformation');
 Route::delete('/information{id}', 'App\Http\Controllers\InformationController@destroy')->name('deleteInformation');

// Search Information
 Route::post('information/search','App\Http\Controllers\InformationController@searchInformation')->name('searchInfo');



// routing login dan register sudah di generate di method routes();
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

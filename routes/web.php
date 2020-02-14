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



Auth::routes();
Route::get('/',function(){
   return(view('welcome')) ;
});
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/company', 'CompanyController@index');
Route::get('/getCompanies/{id}','CompanyController@getCompanies');

Route::get('/type', 'TypeController@index');
Route::get('/getTypes/{id}','TypeController@getTypes');

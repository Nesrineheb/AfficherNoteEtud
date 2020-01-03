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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('sample', 'SampleController');

Route::post('sample/update', 'SampleController@update')->name('sample.update');

Route::get('sample/destroy/{id}', 'SampleController@destroy');

Route::get('full-text-search', 'Full_text_search_Controller@index');

//Route::get('full-text-search/action', 'Full_text_search_Controller@action')->name('full-text-search.action');
Route::get('full-text-search/action', 'Full_text_search_Controller@action');
Route::get('full-text-search/normal-search', 'Full_text_search_Controller@normal_search')->name('full-text-search.normal-search');
Route::resource('ajax-crud-list', 'UsersController');
 Route::post('ajax-crud-list/store', 'UsersController@store');
 Route::get('ajax-crud-list/delete/{id}', 'UsersController@destroy');
 
<?php

use Illuminate\Http\Request;
//http://127.0.0.1:8000/api/reclamation
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/homme', function()
{
    return 'coucou';
});

Route::get('actions','Full_text_search_Controller@action');
Route::get('serache', 'Full_text_search_Controller@normal_search');
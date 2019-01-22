<?php

use Illuminate\Http\Request;

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

Route::group(['prefix' => 'auth'], function ($router) {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});

Route::get('test', 'Api\JobsController@test');
Route::get('jobs', 'Api\JobsController@get');
Route::get('jobs/{job}', 'Api\JobsController@getBy');
Route::get('job-types', 'Api\JobTypesController@get');
Route::get('job-type/{jobType}/jobs', 'Api\JobTypesController@getJobs');
Route::get('cities', 'Api\CitiesController@get');
Route::get('city/{city}/jobs', 'Api\CitiesController@getJobs');
Route::get('categories', 'Api\CategoriesController@get');
Route::get('category/{category}/jobs', 'Api\CategoriesController@getJobs');

Route::post('jobs', 'Api\JobsController@store');

Route::group(['middleware' => 'jwt.auth'], function ($router) {
    Route::post('categories', 'Api\CategoriesController@store');
    Route::patch('categories/{category}', 'Api\CategoriesController@update');
    Route::delete('categories/{category}', 'Api\CategoriesController@destroy');

    Route::post('cities', 'Api\CitiesController@store');
    Route::patch('cities/{city}', 'Api\CitiesController@update');
    Route::delete('cities/{city}', 'Api\CitiesController@destroy');

    Route::patch('jobs/{job}', 'Api\JobsController@update');
    Route::delete('jobs/{job}', 'Api\JobsController@destroy');

    Route::post('job-types', 'Api\JobTypesController@store');
    Route::patch('job-types/{jobType}', 'Api\JobTypesController@update');
    Route::delete('job-types/{jobType}', 'Api\JobTypesController@destroy');

    Route::get('sources', 'Api\SourcesController@get');
    Route::post('sources', 'Api\SourcesController@store');
    Route::patch('sources/{source}', 'Api\SourcesController@update');
    Route::delete('sources/{source}', 'Api\SourcesController@destroy');
    
});
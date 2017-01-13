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
    return view('news');
    //return Redirect::to('/production/today');
});

Route::get('/nav/{view}', function ($view) {
    return view($view);
});

Route::group(['prefix' => 'production'], function () {
    Route::get('/getTodayGlassInfo', 'TodayController@getTodayGlassProduction');
    Route::get('/getTodayImportGlassInfo', 'TodayController@getTodayImportGlassProduction');
    Route::get('/glassInfo/{search}', 'GlassController@getGlassProductionInfo');
    Route::get('/getTodayImportGlassData', 'GlassController@getTodayImportGlassData');
    Route::post('uploadToday', 'TodayController@importTodayData');
    Route::post('uploadGlass', 'GlassController@importGlassData');
});

Route::group(['middleware' => 'ip', 'prefix' => 'production'], function () {
    Route::get('info', 'GlassController@info');
    Route::get('today', 'TodayController@today');
    Route::get('importToday', 'TodayController@importToday');
    Route::get('importGlass', 'GlassController@importGlass');
});


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

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/user/{user}', 'HomeController@index')->name('users_profile');
Route::get('/', 'PagesController@welcome');
Route::get('/autocomplete', 'PagesController@fetch')->name('autocomplete');
Route::get('HallOfFame', 'PagesController@HallOfFame');
Route::get('/donate', 'PagesController@donate')->name('donate');
Route::get('/settings', 'HomeController@user_settings');
Route::post('/user/settings', 'HomeController@ChangeSettings');
Route::get('/tournaments', 'PagesController@Tournaments');
Route::get('/about', 'PagesController@School');
Route::get('/school', 'PagesController@School');
Route::get('/test', 'PagesController@test');


Route::get('/api/check', 'WarbandApiController@check');
Route::get('/api/ft7', 'WarbandApiController@FT7');
Route::post('api/title/change', 'UserSpecialTitlesController@change')->name('title_change');

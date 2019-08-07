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


Route::get('/admin', 'AdminController@index')->name('admin-index');
Route::get('/admin/elo-manipulation', 'AdminPagesController@elo_manipulation')->name('elo-editor');
Route::get('/admin/currency-manipulation', 'AdminPagesController@currency_manipulation')->name('currency-editor');
Route::get('/admin/user-list', 'AdminPagesController@user_list')->name('users-list');
Route::get('admin/tournament/create', 'AdminPagesController@CreateTournament')->name('create-tournament');


Route::get('/admin/api/elo', 'AdminController@ChangeElo')->name('elo_edit_api');
Route::get('/admin/api/currency', 'AdminController@ChangeCurrency')->name('currency_edit_api');


Route::get('/api/check', 'WarbandApiController@check');
Route::get('/api/ft7', 'WarbandApiController@FT7');
Route::post('api/title/change', 'UserSpecialTitlesController@change')->name('title_change');

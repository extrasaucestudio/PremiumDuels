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
Route::get('/tournament/{id}', 'PagesController@Tournament');
Route::get('/about', 'PagesController@School');
Route::get('/school', 'PagesController@School');
Route::get('/test', 'PagesController@test');





Route::get('/api/check', 'WarbandApiController@check');
Route::get('/api/ft7', 'WarbandApiController@FT7');
Route::post('api/title/change', 'UserSpecialTitlesController@change')->name('title_change');



Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/admin', 'AdminController@index')->name('admin-index');
    Route::get('/admin/elo-manipulation', 'AdminPagesController@elo_manipulation')->name('elo-editor');
    Route::get('/admin/currency-manipulation', 'AdminPagesController@currency_manipulation')->name('currency-editor');
    Route::get('/admin/user-list', 'AdminPagesController@user_list')->name('users-list');
    Route::get('admin/tournament/create', 'AdminPagesController@CreateTournament')->name('create-tournament');
    Route::get('admin/tournament/edit/{id}', 'AdminPagesController@EditTournament')->name('edit-tournament');
    Route::post('admin/tournament/edit', 'AdminApiController@EditTournament')->name('edit-tournament-api');
    Route::post('admin/tournament/create', 'AdminApiController@CreateTournament')->name('create-tournament-api');
    Route::get('admin/tournaments/view', 'AdminPagesController@View_Tournaments')->name('view-tournaments');
    Route::post('admin/tournament/delete', 'AdminApiController@DeleteTournament')->name('delete-tournament-api');
    Route::post('/admin/tournament/update/state', 'AdminApiController@UpdateTournamentState');

    //// Inventory System
    Route::get('/admin/item/create', 'ItemController@display_create');
    Route::post('/admin/item/create', 'ItemController@create')->name('item-create');
    Route::get('/admin/item/edit/{id}', 'ItemController@display_edit');
    Route::post('/admin/item/edit', 'ItemController@edit')->name('item-edit');
    Route::get('/admin/item/give/{id}', 'ItemController@display_give');
    Route::post('/admin/item/give', 'ItemController@give')->name('item-give');
    Route::get('/admin/items', 'AdminPagesController@View_Items');



    //// School System
    Route::get('/admin/school/create', 'SchoolController@display_create');
    Route::post('/admin/school/create', 'SchoolController@create')->name('school-create');
    Route::get('/admin/schools', 'SchoolController@view_schools');
    Route::get('/admin/school/edit/{id}', 'SchoolController@display_edit');
    Route::post('/admin/school/edit', 'SchoolController@edit')->name('school-edit');
    Route::get('/admin/school/invite', 'SchoolInviteController@display_invite');
    Route::post('/admin/school/invite', 'SchoolInviteController@invite')->name('school-invite');


    /// Manipulation
    Route::get('/admin/api/elo', 'AdminController@ChangeElo')->name('elo_edit_api');
    Route::get('/admin/api/currency', 'AdminController@ChangeCurrency')->name('currency_edit_api');
});

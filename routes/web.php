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



Route::get('/', 'PagesController@welcome');
Route::get('/autocomplete', 'PagesController@fetch')->name('autocomplete');
Route::get('HallOfFame', 'PagesController@HallOfFame');
Route::get('/donate', 'PagesController@donate')->name('donate');
Route::get('/settings', 'HomeController@user_settings');
Route::post('/user/settings', 'HomeController@ChangeSettings');
Route::get('/tournaments', 'PagesController@Tournaments');
Route::get('/tournament/{id}', 'PagesController@Tournament');
Route::get('/about', 'PagesController@About');

Route::get('/test', 'PagesController@test');
Route::get('/api/players-online', 'PagesController@PlayersOnline');

Route::get('/countries/update', 'CountryController@rank_countries');



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




Route::middleware(['auth'])->group(function () {

    Route::get('/home', 'UserDashboard@index')->name('home');







    //// Titles

    Route::get('/user/title/create', 'SpecialTitleController@display_create');
    Route::post('/user/title/create', 'SpecialTitleController@create')->name('create-title');

    Route::get('/user/title/switch', 'SpecialTitleController@display_switch');
    Route::post('/user/title/switch', 'UserSpecialTitlesController@change')->name('switch-title');



    //// Duel History

    Route::get('/user/duels/history', 'DuelController@DuelHistory');



    //// Inventory System


    Route::get('/user/inventory/switch', 'UserItemsController@display_switch');
    Route::post('/user/inventory/switch', 'UserItemsController@switch')->name('inventory-switch');



    //// Charts

    Route::get('/user/charts', 'UserDashboard@charts');



    //// School


    Route::get('/user/school/create', 'UserSchoolControler@create_display');
    Route::post('/user/school/create', 'UserSchoolControler@create')->name('create-school-user');
    Route::get('/user/school/view', 'UserSchoolControler@display');
    Route::get('/user/school/panel', 'UserSchoolControler@display_panel');
    Route::post('/user/school/panel', 'UserSchoolControler@edit_school');
    Route::get('/school/{schoolID?}', 'UserSchoolControler@display');


    Route::post('/user/school/join', 'UserSchoolControler@join_school');
    Route::get('/user/school/leave', 'UserSchoolControler@leave_school');
    Route::post('/user/school/reject', 'UserSchoolControler@reject_school');


    //// Leaderboard
    Route::get('/user/leaderboard', 'UserDashboard@leaderboard');



    //// User Profile


    Route::get('/user/{uid}', 'UserDashboard@foreign_profile')->name('users_profile');



    /// Notifications

    Route::get('/user/notification/{id}', 'NotificationController@display');
});

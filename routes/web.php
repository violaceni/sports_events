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
//Calendar
Route::redirect('/', '/calendar');
Route::get('/calendar', ['uses' => 'EventsController@calendar', 'as' => 'calendar']);
//Events
Route::get('events', ['uses' => 'EventsController@getEvents', 'as' => 'events']);
Route::post('events/store', ['uses' => 'EventsController@store', 'as' => 'events.store']); 
Route::get('events/index', ['uses' => 'EventsController@index', 'as' => 'events.index']);
Route::post('events/fetchAll', ['uses' => 'EventsController@fetchAll', 'as' => 'events.fetchAll']);
Route::get('events/getDetails/{id}', ['uses' => 'EventsController@getDetails', 'as' => 'events.getDetails']);
Route::post('events/update/{id}', ['uses' => 'EventsController@update', 'as' => 'events.update']);
Route::post('events/delete/{id}', ['uses' => 'EventsController@delete', 'as' => 'events.delete']);

//Categories
Route::get('categories/index', ['uses' => 'CategoriesController@index', 'as' => 'categories.index']);
Route::post('categories/fetchAll', ['uses' => 'CategoriesController@fetchAll', 'as' => 'categories.fetchAll']);
Route::get('categories/create', ['uses' => 'CategoriesController@create', 'as' => 'categories.create']);
Route::post('categories/store', ['uses' => 'CategoriesController@store', 'as' => 'categories.store']); 

//Match
Route::get('matches/index', ['uses' => 'MatchesController@index', 'as' => 'matches.index']);
Route::post('matches/fetchAll', ['uses' => 'MatchesController@fetchAll', 'as' => 'matches.fetchAll']);
Route::get('matches/create', ['uses' => 'MatchesController@create', 'as' => 'matches.create']);
Route::post('matches/store', ['uses' => 'MatchesController@store', 'as' => 'matches.store']); 


//Teams
Route::get('teams/index', ['uses' => 'TeamsController@index', 'as' => 'teams.index']);
Route::post('team/fetchAll', ['uses' => 'TeamsController@fetchAll', 'as' => 'teams.fetchAll']);

//Locations
Route::get('locations/index', ['uses' => 'LocationsController@index', 'as' => 'locations.index']);
Route::post('locations/fetchAll', ['uses' => 'LocationsController@fetchAll', 'as' => 'locations.fetchAll']);


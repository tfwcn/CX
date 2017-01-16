<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', 'WelcomeController@index');
//Route::any('/', 'HomeController@Index');
Route::any('/', 'EventController@Query');
Route::any('/Home/{action}', 'HomeController@Route');
Route::any('/Log/{action}', 'LogController@Route');
Route::any('/Event/', 'EventController@Query');
Route::any('/Event/{action}', 'EventController@Route');

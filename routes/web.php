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
    // $user = App\User::firstOrCreate();

    // dd($user->wasRecentlyCreated);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::view('/difficulty', 'difficulty')->name('difficulty');
Route::get('/flags', 'FlagsController@index')->name('flags');
Route::post('/flags/result', 'FlagsController@show')->name('flags.show');

Route::get('/score', 'ScoreController@index')->name('score');
Route::post('/score/store', 'ScoreController@store')->name('score.store');

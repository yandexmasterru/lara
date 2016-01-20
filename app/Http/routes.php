<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::group(['middleware' => ['web']], function () {
    Route::get('/', 'ExpenseController@showIndex')->name('home');
    
    Route::get('/period/', 'ExpenseController@showPeriod')->name('period');
    Route::get('/list/{period}', 'ExpenseController@showList')->name('list-expenses');
    
    Route::get('/add', 'ExpenseController@showAdd')->name('add-expense');
    Route::post('/add', 'ExpenseController@postAdd')->name('post-expense');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});

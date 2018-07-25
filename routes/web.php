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

Route::get('/', 'AuthController@choseStatus');

//  INVESTMENTS-ADMIN
Route::group([ 'prefix' => 'investment-admin'], function () {
    Route::get('/dashboard', 'AdminInvestmentUserController@dashboard');
    Route::get('/create', 'AdminInvestmentController@create');
    // WITHOUT MIDDLEWARE
    Route::get('/login', 'AdminInvestmentUserController@getSignIn');
    Route::post('/sign-up', 'AdminInvestmentUserController@signUp');
    Route::post('/sign-in', 'AdminInvestmentUserController@signIn');
});

//  INVESTOR
Route::group([ 'prefix' => 'investment'], function () {

    // WITHOUT MIDDLEWARE
    Route::get('login', 'InvestmentController@getSignIn')->name('investment-login');
});

//  EMPLOYEE
Route::group([ 'prefix' => 'employee'], function () {

    // WITHOUT MIDDLEWARE
    Route::get('login', 'EmployeeController@getSignIn')->name('employee-login');
});

//  COMPANY
Route::group([ 'prefix' => 'owner'], function () {

    // WITHOUT MIDDLEWARE
    Route::get('login', 'OwnerController@getSignIn')->name('owner-login');
});

Route::get('logout', 'AuthController@getLogout');



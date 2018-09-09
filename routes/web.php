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
    // WITH MIDDLEWARE
    Route::group(['middleware' => ['check-admin-investments']], function () {
        Route::get('/dashboard', 'AdminInvestmentUserController@dashboard');
        Route::get('/create', 'AdminInvestmentController@create');
        Route::get('/get-all-investments', 'AdminInvestmentController@getAllInvestments');
        Route::get('/detail/{id}', 'AdminInvestmentController@detail');
        Route::get('/reject/{id}', 'AdminInvestmentController@reject');
        Route::get('/delete/{id}', 'AdminInvestmentController@delete');
        Route::get('/approve-or-un-approve/{id}', 'AdminInvestmentController@approveOrUnApprove');
        Route::get('/before-confirm/{id}', 'AdminInvestmentController@beforeConfirm');
        Route::post('/confirm/{id}', 'AdminInvestmentController@confirm');
        Route::get('/delete/{id}', 'AdminInvestmentController@delete');
        Route::post('/store', 'AdminInvestmentController@store');
        Route::get('/edit/{id}', 'AdminInvestmentController@edit');
        Route::post('/update/{id}', 'AdminInvestmentController@update');
    });
    // WITHOUT MIDDLEWARE
    Route::get('/login', 'AdminInvestmentUserController@getSignIn');
    Route::post('/sign-up', 'AdminInvestmentUserController@signUp');
    Route::post('/sign-in', 'AdminInvestmentUserController@signIn');
});

//  INVESTOR
Route::group([ 'prefix' => 'investor'], function () {
    // WITH MIDDLEWARE
    Route::group(['middleware' => ['check-investor']], function () {
        Route::get('/dashboard', 'InvestorUserController@dashboard');
        Route::get('/get-all/{country}', 'InvestorController@getAllFromCountry');
        Route::get('/{country}/get-all-and-selected/{id}', 'InvestorController@getAllAndSelected');
    });
    // WITHOUT MIDDLEWARE
    Route::get('/login', 'InvestorUserController@getSignIn');
    Route::post('/sign-up', 'InvestorUserController@signUp');
    Route::post('/sign-in', 'InvestorUserController@signIn');
});

//  OWNER  COMPANY
Route::group([ 'prefix' => 'owner'], function () {
    // WITH MIDDLEWARE
    Route::group(['middleware' => ['check-owner']], function () {
        Route::get('/dashboard', 'OwnerUserController@dashboard');
    });
    // WITHOUT MIDDLEWARE
    Route::get('/login', 'OwnerUserController@getSignIn');
    Route::post('/sign-up', 'OwnerUserController@signUp');
    Route::post('/sign-in', 'OwnerUserController@signIn');
});

//  INVESTMENT
Route::group([ 'prefix' => 'investment'], function () {
    // WITH MIDDLEWARE
    Route::post('/invest/{id}', 'InvestmentController@invest');
});

//  EMPLOYEE
Route::group([ 'prefix' => 'employee'], function () {

    // WITHOUT MIDDLEWARE
    Route::get('login', 'EmployeeController@getSignIn')->name('employee-login');
});

Route::get('logout', 'AuthController@getLogout');



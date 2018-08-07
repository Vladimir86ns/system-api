<?php

use Illuminate\Http\Request;
use Dingo\Api\Routing\Router;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$api = app(Router::class);

$api->version('v1', function ($api) {
    $api->group(['namespace' => 'App\Http\Controllers\Api', 'middleware' => 'api'], function (Router $api) {
        $api->post('register-company', 'CompanyUserRegisterController@register');
        $api->post('login-company', 'CompanyUserRegisterController@login');

        // company
        $api->group([ 'prefix' => 'company'], function ($api) {
            $api->get('get-product-categories/{id}', 'CompanyProductController@getProductCategories');
            $api->get('products/{id}', 'CompanyProductController@getProducts');
        });
    });
    $api->group(['namespace' => 'App\Http\Controllers'], function (Router $api) {
        //
    });
});

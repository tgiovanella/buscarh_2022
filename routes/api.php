<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('cities/{uf?}/{id?}', 'Api\City@cities');
Route::get('cities-uf/{ids?}', 'Api\City@citiesUF');
Route::get('cities-like/{term?}', 'Api\City@citiesLike');

Route::get('users-like/{term?}', 'Api\UsersController@usersLike');


Route::get('companies-like/{term?}', 'Api\CompanyController@companiesLike');
Route::get('companies/{id}', 'Api\CompanyController@company');

//
Route::get('ads/full/{category?}', 'Api\AdsController@full');
Route::get('ads/slide-logo', 'Api\AdsController@slideLogo');
Route::get('ads/slide-cloud', 'Api\AdsController@slideCloud');
Route::get('ads/slide-sidebar/{category?}', 'Api\AdsController@slideSidebar');



Route::get('analytics/seach', 'Api\AnalyticsController@search');


Route::get('categories/{id?}', 'Api\CategoryController@categories');
Route::get('subcategories/{id}', 'Api\CategoryController@subcategories');

Route::get('ads-config/{id?}', 'Api\PlaneController@configuration');

Route::get('pagseguro/notification', 'Api\PagSeguroController@notification');

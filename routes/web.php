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

/*
    FEATURE LOGIN
*/
Route::get('/merchant/login', [ 'as' => 'merchant.index', 'uses' => 'MerchantController@index' ]);
Route::post('/merchant/doLogin', [ 'as' => 'merchant.doLogin', 'uses' => 'MerchantController@doLogin' ]);
Route::get('/merchant/logout', [ 'as' => 'merchant.destroy', 'uses' => 'MerchantController@destroy' ]);

/*
    dashboard merchant
*/
Route::group(['middleware' => ['checkMerchantLogin']], function () {
    Route::group([ 'prefix' => 'merchant'], function () {
        Route::get('/dashboard', [ 'as' => 'mainMerchant.index', 'uses' => 'DashboardMerchantController@index' ]);
        Route::get('/setting-outlate', [ 'as' => 'setting.outlate', 'uses' => 'SettingMerchantController@index' ]);
        Route::post('/setting-getKampus', [ 'as' => 'setting.getKampus', 'uses' => 'SettingMerchantController@getKampus' ]);
        Route::post('/setting-save', [ 'as' => 'setting.doSaveConfig', 'uses' => 'SettingMerchantController@doSaveConfig' ]);
        Route::post('/setting-open-close-save', [ 'as' => 'setting.doSaveOpenClose', 'uses' => 'SettingMerchantController@doSaveOpenClose' ]);
        Route::post('/setting-open-update', [ 'as' => 'setting.doUpdateOpenToko', 'uses' => 'SettingMerchantController@doUpdateOpenToko' ]);

        Route::get('/product-merchant', [ 'as' => 'productMerchant.index', 'uses' => 'ProductMerchantController@index' ]);
    });
});
//
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

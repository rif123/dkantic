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
Route::get('/merchant/logsout', [ 'as' => 'merchant.destroy', 'uses' => 'MerchantController@destroy' ]);


/*
    FEATURE LOGIN
*/
Route::get('/admin/login', [ 'as' => 'admin.index', 'uses' => 'AdminController@index' ]);
Route::post('/admin/doLogin', [ 'as' => 'admin.doLogin', 'uses' => 'AdminController@doLogin' ]);
Route::get('/admin/logout', [ 'as' => 'admin.destroy', 'uses' => 'AdminController@destroy' ]);


/*
 *  Dashboard merchant
 *  Created :  rifky 
 * 
 */
Route::group(['middleware' => ['checkAdminLogin']], function () {
    Route::group([ 'prefix' => 'admin'], function () {
        Route::get('/dashboard', [ 'as' => 'admindashboard.index', 'uses' => 'dashBoardAdminController@index' ]);
        Route::get('/setting-website', [ 'as' => 'setting.website', 'uses' => 'AdminSettingWebsiteController@index' ]);
        Route::post('/setting-website-save', [ 'as' => 'setting.wsebsite.save', 'uses' => 'AdminSettingWebsiteController@doSaveConfig' ]);

        Route::group([ 'prefix' => 'master'], function () {
            Route::get('/', [ 'as' => 'masterAdmin.index', 'uses' => 'MasterController@index' ]);
            
            // kota
            Route::get('/kota', [ 'as' => 'masterKota.index', 'uses' => 'MkotaController@index' ]);
            Route::get('/data-kota', [ 'as' => 'masterKota.getKota', 'uses' => 'MkotaController@getKota' ]);
            Route::post('/kota-save', [ 'as' => 'masterKota.create', 'uses' => 'MkotaController@create' ]);
            Route::post('/kota-update', [ 'as' => 'masterKota.update', 'uses' => 'MkotaController@update' ]);
            Route::post('/kota-delete', [ 'as' => 'masterKota.delete', 'uses' => 'MkotaController@delete' ]);

            // kampus
            Route::get('/kampus', [ 'as' => 'masterKampus.index', 'uses' => 'MkampusController@index' ]);
            Route::get('/data-kampus', [ 'as' => 'masterKampus.getkampus', 'uses' => 'MkampusController@getkampus' ]);
            Route::post('/kampus-save', [ 'as' => 'masterKampus.create', 'uses' => 'MkampusController@create' ]);
            Route::post('/kampus-update', [ 'as' => 'masterKampus.update', 'uses' => 'MkampusController@update' ]);
            Route::post('/kampus-delete', [ 'as' => 'masterKampus.delete', 'uses' => 'MkampusController@delete' ]);


            // Kategory
            Route::get('/kategori', [ 'as' => 'masterKategori.index', 'uses' => 'MkategoriController@index' ]);
            Route::get('/data-kategori', [ 'as' => 'masterKategori.getKategori', 'uses' => 'MkategoriController@getKategori' ]);
            Route::post('/kategori-save', [ 'as' => 'masterKategori.create', 'uses' => 'MkategoriController@create' ]);
            Route::post('/kategori-update', [ 'as' => 'masterKategori.update', 'uses' => 'MkategoriController@update' ]);
            Route::post('/kategori-delete', [ 'as' => 'masterKategori.delete', 'uses' => 'MkategoriController@delete' ]);

             // merchant
            Route::get('/merchant', [ 'as' => 'masterMerchant.index', 'uses' => 'MmerchantController@index' ]);
            Route::get('/data-merchant', [ 'as' => 'masterMerchant.getMerchant', 'uses' => 'MmerchantController@getMerchant' ]);
            Route::post('/data-detail-merchant', [ 'as' => 'masterMerchant.getDetailMerchant', 'uses' => 'MmerchantController@getDetailMerchant' ]);
            Route::post('/data-list-image', [ 'as' => 'masterMerchant.getListImageProd', 'uses' => 'MmerchantController@getListImageProd' ]);
            Route::post('/merchant-save', [ 'as' => 'masterMerchant.create', 'uses' => 'MmerchantController@create' ]);
            Route::post('/merchant-update', [ 'as' => 'masterMerchant.update', 'uses' => 'MmerchantController@update' ]);
            Route::post('/merchant-delete', [ 'as' => 'masterMerchant.delete', 'uses' => 'MmerchantController@delete' ]);

            Route::get('/merchant-get-kampus', [ 'as' => 'masterMerchant.getKampus', 'uses' => 'MmerchantController@getKampus' ]);            
            Route::post('/merchant-filter', [ 'as' => 'masterMerchant.filterMerchant', 'uses' => 'MmerchantController@filterMerchant' ]);            


             // Promo
             Route::get('/promo', [ 'as' => 'promoLanding.index', 'uses' => 'PromoController@index' ]);

        });

        Route::group([ 'prefix' => 'manage'], function () {
            Route::get('/', [ 'as' => 'manageAdmin.index', 'uses' => 'MmanageController@index' ]);
        });
        
        
    });
});


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
        Route::post('/product-merchant-store', [ 'as' => 'productMerchant.store', 'uses' => 'ProductMerchantController@store' ]);
        Route::post('/product-merchant-view', [ 'as' => 'productMerchant.preview', 'uses' => 'ProductMerchantController@preview' ]);

        Route::post('/product-merchant-update', [ 'as' => 'productMerchant.update', 'uses' => 'ProductMerchantController@update' ]);
        Route::post('/product-merchant-edit', [ 'as' => 'productMerchant.edit', 'uses' => 'ProductMerchantController@edit' ]);
        Route::post('/product-merchant-prod-delete', [ 'as' => 'productMerchant.deleteProd', 'uses' => 'ProductMerchantController@deleteProd' ]);
        Route::post('/product-merchant-delete-image', [ 'as' => 'productMerchant.deleteImage', 'uses' => 'ProductMerchantController@deleteImage' ]);

    });
});




//
Route::get('/', function () {
    return view('welcome');
});
    
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

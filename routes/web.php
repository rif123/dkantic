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
Route::get('/', [ 'as' => 'fe.index', 'uses' => 'FeMainMageController@index' ]);

/*
    FEATURE LOGIN merchant
*/
Route::get('/merchant/login', [ 'as' => 'merchant.index', 'uses' => 'MerchantController@index' ]);
Route::post('/merchant/doLogin', [ 'as' => 'merchant.doLogin', 'uses' => 'MerchantController@doLogin' ]);
Route::get('/merchant/logsout', [ 'as' => 'merchant.destroy', 'uses' => 'MerchantController@destroy' ]);


/*
    FEATURE LOGIN admin
*/
Route::get('/admin/login', [ 'as' => 'admin.index', 'uses' => 'AdminController@index' ]);
Route::post('/admin/doLogin', [ 'as' => 'admin.doLogin', 'uses' => 'AdminController@doLogin' ]);
Route::get('/admin/logout', [ 'as' => 'admin.destroy', 'uses' => 'AdminController@destroy' ]);

/*
    FEATURE LOGIN user
*/
Route::get('/auth/login', [ 'as' => 'user.login', 'uses' => 'AuthController@index' ]);
Route::post('/auth/do-login', [ 'as' => 'user.doLogin', 'uses' => 'AuthController@doLogin' ]);
Route::get('/auth/logout', [ 'as' => 'user.doLogout', 'uses' => 'AuthController@doLogout' ]);
Route::post('/auth/doRegister', [ 'as' => 'user.doReg', 'uses' => 'AuthController@doReg' ]);
Route::get('/auth/forgot-password', [ 'as' => 'user.showForgotPassword', 'uses' => 'AuthController@showForgotPassword' ]);
Route::post('/auth/do-forgor-password', [ 'as' => 'user.doForgotPassword', 'uses' => 'AuthController@doForgotPassword' ]);





Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');


Route::group([ 'prefix' => 'user'], function () {
    Route::get('/profile', [ 'as' => 'user.profile', 'uses' => 'ProfileController@index' ]);
    Route::post('/do-update-profile', [ 'as' => 'user.doUpdateProfile', 'uses' => 'ProfileController@doUpdateProfile' ]);
});




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

            Route::get('/kategori-favorite', [ 'as' => 'masterKategori.Favoriteindex', 'uses' => 'MkategoriController@favoriteKategori' ]);
            Route::get('/data-favorite-kategori', [ 'as' => 'masterKategori.getFavoriteKategori', 'uses' => 'MkategoriController@getFavoriteKategori' ]);
            Route::post('/kategori-favorite-save', [ 'as' => 'masterKategori.createFavorite', 'uses' => 'MkategoriController@createFavorite' ]);
            Route::post('/kategori-favorite-delete', [ 'as' => 'masterKategori.deleteFavorite', 'uses' => 'MkategoriController@deleteFavorite' ]);
            


             // merchant
            Route::get('/merchant', [ 'as' => 'masterMerchant.index', 'uses' => 'MmerchantController@index' ]);
            Route::get('/data-merchant', [ 'as' => 'masterMerchant.getMerchant', 'uses' => 'MmerchantController@getMerchant' ]);
            Route::post('/data-detail-merchant', [ 'as' => 'masterMerchant.getDetailMerchant', 'uses' => 'MmerchantController@getDetailMerchant' ]);
            Route::post('/data-list-image', [ 'as' => 'masterMerchant.getListImageProd', 'uses' => 'MmerchantController@getListImageProd' ]);
            Route::get('/merchant-do-show', [ 'as' => 'masterMerchant.doShow', 'uses' => 'MmerchantController@doShow' ]);
            

            Route::post('/merchant-save', [ 'as' => 'masterMerchant.create', 'uses' => 'MmerchantController@create' ]);
            Route::post('/merchant-update', [ 'as' => 'masterMerchant.update', 'uses' => 'MmerchantController@update' ]);
            Route::post('/merchant-delete', [ 'as' => 'masterMerchant.delete', 'uses' => 'MmerchantController@delete' ]);

            Route::get('/merchant-get-kampus', [ 'as' => 'masterMerchant.getKampus', 'uses' => 'MmerchantController@getKampus' ]);            
            Route::post('/merchant-filter', [ 'as' => 'masterMerchant.filterMerchant', 'uses' => 'MmerchantController@filterMerchant' ]);    
            
            Route::get('/produk', [ 'as' => 'ProductAdmin.index', 'uses' => 'ProductAdminController@index' ]);    
            Route::get('/list-produk', [ 'as' => 'ProductAdmin.listProduk', 'uses' => 'ProductAdminController@listProduk' ]);    
            Route::get('/form-add-produk', [ 'as' => 'ProductAdmin.formProduk', 'uses' => 'ProductAdminController@formProduk' ]);    
            Route::post('/form-save-produk', [ 'as' => 'ProductAdmin.formProdukSave', 'uses' => 'ProductAdminController@formProdukSave' ]);
            Route::post('/produk-edit-show', [ 'as' => 'ProductAdmin.showEdit', 'uses' => 'ProductAdminController@showEdit' ]); 
            Route::post('/form-update-produk', [ 'as' => 'ProductAdmin.formProdukUpdate', 'uses' => 'ProductAdminController@formProdukUpdate' ]);
            Route::post('/form-delete-produk', [ 'as' => 'ProductAdmin.deleteProd', 'uses' => 'ProductAdminController@deleteProd' ]);
        });

        

        Route::group([ 'prefix' => 'promo'], function () {  // Promo
            Route::get('/', [ 'as' => 'promoLanding.index', 'uses' => 'PromoController@index' ]); 
            // promo origin
            Route::get('/promo-origin', [ 'as' => 'promolanding.index', 'uses' => 'PromoOriginController@index' ]);
            Route::get('/promo-get-origin', [ 'as' => 'promoOrigin.getPromo', 'uses' => 'PromoOriginController@getPromo' ]);
            Route::get('/promo-role-prod', [ 'as' => 'promoOrigin.getRolePromo', 'uses' => 'PromoOriginController@getRolePromo' ]);
            Route::post('/promo-form', [ 'as' => 'promoOrigin.showFormPromo', 'uses' => 'PromoOriginController@showFormPromo' ]);
            Route::post('/promo-edit-form', [ 'as' => 'promoOrigin.showFormPromoEdit', 'uses' => 'PromoOriginController@showFormPromoEdit' ]);
            Route::post('/promo-save', [ 'as' => 'promoOrigin.doSavePromo', 'uses' => 'PromoOriginController@doSavePromo' ]);
            Route::post('/promo-update', [ 'as' => 'promoOrigin.doUpdatePromo', 'uses' => 'PromoOriginController@doUpdatePromo' ]);
            Route::post('/promo-delete', [ 'as' => 'promoOrigin.doDeletePromo', 'uses' => 'PromoOriginController@doDeletePromo' ]);
           
            Route::post('/promo-save-items', [ 'as' => 'promoOrigin.doSaveRoleItems', 'uses' => 'PromoOriginController@doSaveRoleItems' ]);
            Route::get('/promo-list', [ 'as' => 'promoOrigin.getPromoList', 'uses' => 'PromoOriginController@getPromoList' ]);
            Route::get('/promo-get-outlate', [ 'as' => 'promoOrigin.getOutlate', 'uses' => 'PromoOriginController@getOutlate' ]);
            Route::post('/promo-get-product', [ 'as' => 'promoOrigin.getProduk', 'uses' => 'PromoOriginController@getProduk' ]);


            Route::get('/promo-from-items', [ 'as' => 'promoOrigin.showFormItems', 'uses' => 'PromoOriginController@showFormItems' ]);
            

            // promo origin
            Route::get('/promo-slider', [ 'as' => 'promoSLideLanding.index', 'uses' => 'PromoSliderController@index' ]);
            Route::get('/promo-get-slide', [ 'as' => 'promoSLideLanding.getSlide', 'uses' => 'PromoSliderController@getSlide' ]);
            Route::get('/promo-role-prod-slide', [ 'as' => 'promoSLideLanding.getRolePromoSlide', 'uses' => 'PromoSliderController@getRolePromoSlide' ]);
            Route::post('/promo-form-slide', [ 'as' => 'promoSLideLanding.showFormPromoSlide', 'uses' => 'PromoSliderController@showFormPromoSlide' ]);
            Route::post('/promo-edit-form-slide', [ 'as' => 'promoSLideLanding.showFormPromoSlideEdit', 'uses' => 'PromoSliderController@showFormPromoEdit' ]);
            Route::post('/promo-delete-slide', [ 'as' => 'promoSLideLanding.doDeletePromoItem', 'uses' => 'PromoSliderController@doDeletePromoItem' ]);
            Route::get('/promo-from-items-slide', [ 'as' => 'promoSLideLanding.showFormItemsSlide', 'uses' => 'PromoSliderController@showFormItemsSlide' ]);

            Route::get('/promo-list-items', [ 'as' => 'promoSLideLanding.getPromoListItems', 'uses' => 'PromoSliderController@getPromoListItems' ]);
            Route::post('/promo-save-slide-items', [ 'as' => 'promoSLideLanding.doSaveRoleSlideItems', 'uses' => 'PromoSliderController@doSaveRoleSlideItems' ]);

            Route::post('/promo-save-slide', [ 'as' => 'promoSLideLanding.doSaveSlide', 'uses' => 'PromoSliderController@doSaveSlide' ]);
            Route::post('/promo-update-slide', [ 'as' => 'promoSLideLanding.doUpdatePromoSlide', 'uses' => 'PromoSliderController@doUpdatePromoSlide' ]);
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




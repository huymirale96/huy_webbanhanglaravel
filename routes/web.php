<?php

use Illuminate\Support\Facades\Auth;

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
Route::group(['namespace' => 'Website'], function () {
    Route::post('login', 'CustomerController@postLogin')->name('customer.login');
    Route::post('logout', 'CustomerController@logout')->name('customer.logout');
    Route::post('register', 'CustomerController@postRegister')->name('customer.register');

    Route::group(['middleware' => 'CheckLoginCustomer'], function () {
        Route::post('trang-ca-nhan', 'CustomerController@changeProfile')->name('customer.change_profile');
        Route::get('don-hang', 'CustomerController@getListOrder')->name('customer.history.order');
        Route::get('chi-tiet-don-hang', 'CustomerController@getOrderDetail')->name('customer.order_detail');
        Route::post('doi-mat-khau', 'CustomerController@changePassword')->name('customer.change_password');
    });

    Route::post('quen-mat-khau', 'CustomerController@sendRequestForgotPassword')->name('customer.forgot_password');
    Route::get('token/{token}', 'CustomerController@checkToken')->name('customer.check_token');
    Route::post('dat-mat-khau', 'CustomerController@setPassword')->name('customer.set_password');

    Route::resource('cart', 'CartController')->except('edit', 'show', 'create');
    Route::get('cart/user-info', 'CartController@getUser')->name('cart.user_info');
    Route::get('cart/districts', 'CartController@getDistrict')->name('cart.districts');
    Route::get('cart/wards', 'CartController@getWard')->name('cart.wards');
    Route::post('cart/confirm', 'CartController@confirmOrder')->name('cart.confirm')->middleware('CheckLoginCustomer');
    Route::post('cart/confirm-vnpay', 'CartController@confirmOrderVnpay')->name('cart.confirm_vnpay');
    Route::post('cart/delete-all', 'CartController@deleteAllCart')->name('cart.delete_all_cart');
    Route::get('VnPayReturn', 'CartController@vnpayreturn')->name('vnpay');

    Route::get('/', 'PageController@index');
    Route::get('tim-kiem', 'PageController@searchProduct')->name('search_product');
    Route::post('binh-luan', 'PageController@postComment')->name('product.comment')->middleware('CheckLoginCustomer');
    Route::get('tin-tuc', 'PageController@getListNew')->name('list_new');
    Route::get('tin-tuc/{slug}', 'PageController@getNewDetail')->name('new_detail');
    Route::get('khuyen-mai/{slug}', 'PageController@getPromotionDetail')->name('promotion_detail');
    Route::get('chinh-sach', 'PageController@getPolicy')->name('policy_detail');

});
Route::get('test', 'Admin\UserController@test');
Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {
    Route::group(['middleware' => 'CheckAdminLogout'], function () {
        Route::get('login', 'AuthController@getLogin')->name('admin.get_login');
        Route::post('login', 'AuthController@postLogin')->name('admin.post_login');
        Route::post('forgot-password', 'AuthController@sendRequestForgotPassword')->name('admin.forgot_password');
        Route::get('token/{token}', 'AuthController@checkToken')->name('admin.check_token');
        Route::post('token', 'AuthController@resetPassword')->name('admin.reset_password');
    });
    Route::group(['middleware' => 'CheckAdminLogin'], function () {
        Route::post('logout', 'AuthController@postLogout')->name('admin.logout');
        Route::get('profile', 'AuthController@getProfile')->name('admin.profile');
        Route::post('profile', 'AuthController@postProfile')->name('admin.change_profile');
        Route::post('change-password', 'AuthController@changePassword')->name('admin.change_password');
    });
    Route::group(['middleware' => 'Admin'], function () {
        Route::get('/', 'HomeController@index')->name('admin.home');
        Route::get('statistics', 'OrderController@getStatistics')->name('admin.statistics');
        Route::group(['prefix' => 'products'], function () {
            Route::get('/', 'ProductController@index')->name('admin.products');
            Route::get('/add', 'ProductController@createProduct')->name('admin.products.get_add_product');
            Route::post('/add', 'ProductController@storeProduct')->name('admin.products.post_add_product');
            Route::get('{product}/edit', 'ProductController@editProduct')->name('admin.products.get_edit_product');
            Route::post('{product}/edit', 'ProductController@updateProduct')->name('admin.products.post_edit_product');
            Route::delete('{product}/delete', 'ProductController@deleteProduct')->name('admin.products.delete');
            Route::delete('image/{image}/delete', 'ProductController@deleteImage')->name('admin.products.delete_image');
            Route::delete('option/{option}/delete', 'ProductController@deleteOption')->name('admin.products.delete_option');
            Route::post('{id}/restore', 'ProductController@restoreProduct')->name('admin.products.restore');
        });
        Route::group(['prefix' => 'brands'], function () {
            Route::get('/', 'BrandController@index')->name('admin.brands');
            Route::get('add', 'BrandController@createBrand')->name('admin.brands.get_add_brand');
            Route::post('add', 'BrandController@storeBrand')->name('admin.brands.post_add_brand');
            Route::get('{brand}/edit', 'BrandController@editBrand')->name('admin.brands.get_edit_brand');
            Route::post('{brand}/edit', 'BrandController@updateBrand')->name('admin.brands.post_edit_brand');
            Route::delete('{brand}/delete', 'BrandController@deleteBrand')->name('admin.brands.delete');
            Route::post('{id}/restore', 'BrandController@restoreBrand')->name('admin.brands.restore');
        });
        Route::group(['prefix' => 'categories'], function () {
            Route::get('/', 'CategoryController@index')->name('admin.categories');
//            Route::get('/add', 'CategoryController@create');
//            Route::post('/add', 'CategoryController@store');
//            Route::get('{category}/edit', 'CategoryController@Edit')->name('admin.category.get-edit-category');
            Route::post('{category}/edit', 'CategoryController@updateCategory')->name('admin.categories.post_edit_category');
//            Route::get('{category}/delete', 'CategoryController@destroy');
        });
        Route::group(['prefix' => 'customers'], function () {
            Route::get('/', 'CustomerController@index')->name('admin.customers');
            Route::get('{id}/profile', 'CustomerController@getProfile')->name('admin.customers.profile');
        });
        Route::group(['prefix' => 'orders'], function () {
            Route::get('/', 'OrderController@index')->name('admin.orders');
            Route::get('{order}/detail', 'OrderController@getDetail')->name('admin.orders.detail');
            Route::post('{order}/update', 'OrderController@updateOrder')->name('admin.orders.update');

        });
        Route::group(['prefix' => 'news'], function () {
            Route::get('/', 'NewController@index')->name('admin.news');
            Route::get('/add', 'NewController@createNew')->name('admin.news.get_add_new');
            Route::post('/add', 'NewController@storeNew')->name('admin.news.post_add_new');
            Route::get('{new}/edit', 'NewController@editNew')->name('admin.news.get_edit_new');
            Route::post('{new}/edit', 'NewController@updateNew')->name('admin.news.post_edit_new');
            Route::delete('{new}/delete', 'NewController@deleteNew')->name('admin.news.delete');
            Route::post('{new}/restore', 'NewController@restoreNew')->name('admin.news.restore');
        });
        Route::group(['prefix' => 'banners'], function () {
            Route::get('/', 'BannerController@index')->name('admin.banners');
            Route::get('/add', 'BannerController@createBanner')->name('admin.banners.get_add_banner');
            Route::post('/add', 'BannerController@storeBanner')->name('admin.banners.post_add_banner');
            Route::get('{banner}/edit', 'BannerController@editBanner')->name('admin.banners.get_edit_banner');
            Route::post('{banner}/edit', 'BannerController@updateBanner')->name('admin.banners.post_edit_banner');
            Route::delete('{banner}/delete', 'BannerController@deleteBanner')->name('admin.banners.delete');
            Route::post('{banner}/restore', 'BannerController@restoreBaner')->name('admin.banners.restore');
        });
    });
    Route::group(['prefix' => 'users', 'middleware' => 'SuperAdmin'], function () {
        Route::get('/', 'UserController@index')->name('admin.users');
        Route::get('/add', 'UserController@createUser')->name('admin.users.get_add_user');
        Route::post('/add', 'UserController@storeUser')->name('admin.users.post_add_user');
        Route::delete('{user}/disable', 'UserController@disableUser')->name('admin.users.disable');
        Route::post('{user}/restore', 'UserController@restoreUser')->name('admin.users.restore');
        Route::post('{user}/reset', 'UserController@resetUser')->name('admin.users.reset');
    });
});

Route::get('{category}', 'Website\PageController@getListProduct')->name('category');
Route::get('{c_slug}/{p_slug}', 'Website\PageController@getProductDetail')->name('product.detail');

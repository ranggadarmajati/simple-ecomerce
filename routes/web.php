<?php

/*
|--------------------------------------------------------------------------
| Web Routes echakids.com
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
| Author: Rangga Darmajati ( WA: 085721731478 | Email: rangga.android69@gmail.com )
*/

// Route Home
Route::get('/', 'HomeController@index')->name('home');
Route::get('product_home', 'HomeController@product')->name('product_home');
Route::get('get_product', 'ProductController@getDataProduk')->name('get_product');

// Route Product
Route::group(['prefix' => 'product'], function () {
	Route::get('/', 'ProductController@index')->name('product');
	Route::get('/{id}/detail', 'ProductController@show')->name('product_detail');
	Route::get('product_related', 'ProductController@related_product')->name('product_related');
});

// Route Cart
Route::get('cart', 'CartController@index')->name('cart');
Route::get('cart_update', 'CartController@update')->name('cart_update');
Route::get('cart_remove/{id}/delete', 'CartController@destroy')->name('cart_remove');
Route::post('add_chart_home', 'CartController@store_home')->name('add_chart_home');
Route::post('add_cart_product', 'CartController@add_cart_product')->name('add_cart_product');
Route::post('add_chart_product_detail', 'CartController@add_chart_product_detail')->name('add_chart');

// Route Transaction
Route::get('order_confirm', 'TransactionController@index')->name('order_confirm');
Route::post('order', 'TransactionController@store')->name('order');
Route::get('order_detail/{id}', 'TransactionController@show')->name('order_detail');
Route::post('get_payment', 'TransactionController@getConfirmPayment')->name('get_payment');
Route::post('store_payment', 'TransactionController@StorePayment')->name('store_payment');

// Route About
Route::get('about', 'AboutController@index')->name('about');

// Route Contact
Route::get('contact', 'ContactController@index')->name('contact');

// Route Auth
Route::group(['namespace' => 'Auth', 'as' => 'auth.'], function () {
	Route::get('auth', 'LoginController@LoginForm')->name('auth');
	Route::get('register', 'LoginController@RegisterForm');
	Route::post('login', 'LoginController@store')->name('login');
	Route::get('logout', 'LoginController@logout')->name('logout');
	Route::get('admin_logout', 'LoginController@admin_logout')->name('admin_logout');
	Route::post('register_user', 'LoginController@register')->name('register_user');
	Route::post('forgot_password', 'LoginController@forgot_password')->name('forgot_password');
	// Route Verifications
	Route::get('{verify_code}/verifikasi_akun', 'LoginController@verifications')->name('verifications');
});


Route::get('verify_template', function () {
	return view('mails.verify');
});

// Route Admin
Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'adminsession'], function () {
	// Dashboard
	Route::get('/', 'DashboardController@index')->name('index');

	// Data Chart
	Route::get('DataTransactionChart', 'DashboardController@TransactionChart')->name('DataTransactionChart');

	// OrderProsess
	Route::get('transaksi_order', 'OrderProssesController@index')->name('transaksi_order');
	Route::get('transaksi_delivery', 'OrderProssesController@index_delivery')->name('transaksi_delivery');
	Route::get('datatable_order', 'OrderProssesController@datatableOrder')->name('datatable_order');
	Route::get('datatable_order_confirm', 'OrderProssesController@datatableOrderConfirm')->name('datatable_order_confirm');
	Route::get('datatable_tracking_confirm', 'OrderProssesController@datatableConfirmTracking')->name('datatable_tracking_confirm');
	Route::get('datatable_tracking_confirm_done', 'OrderProssesController@datatableConfirmTrackingDelivery')->name('datatable_tracking_confirm_done');
	Route::get('view_detail_order/{id}', 'OrderProssesController@show')->name('view_detail_order');
	Route::get('view_confirm_order/{id}', 'OrderProssesController@show_confirm')->name('view_confirm_order');
	Route::get('print_order_detail/{id}', 'OrderProssesController@print_order_detail')->name('print_order_detail');
	Route::get('view_confirm_delivery/{id}', 'OrderProssesController@show_delivery')->name('view_confirm_delivery');
	Route::post('confirm_order', 'OrderProssesController@confirm_order')->name('confirm_order');
	Route::post('confirm_delivery', 'OrderProssesController@confirm_delivery')->name('confirm_delivery');

	// Product
	Route::get('product', 'ProductController@index')->name('product');
	Route::get('datatable_product', 'ProductController@DataTableProduct')->name('datatable_product');
	Route::get('create_product', 'ProductController@create')->name('create_product');
	Route::get('detail_product/{id}', 'ProductController@show')->name('detail_product');
	Route::get('edit_product/{id}', 'ProductController@edit')->name('edit_product');
	Route::post('store_product', 'ProductController@store')->name('store_product');
	Route::post('update_product/{id}', 'ProductController@update')->name('update_product');
	Route::post('update_size/{id}', 'ProductController@updateSize')->name('update_size');
	Route::post('add_size/{id}', 'ProductController@addSize')->name('add_size');
	Route::get('destroy_size/{id}', 'ProductController@destroy_size')->name('destroy_size');
	Route::post('update_color/{id}', 'ProductController@update_color')->name('update_color');
	Route::post('add_color/{id}', 'ProductController@addColor')->name('add_color');
	Route::get('destroy_color/{id}', 'ProductController@destroy_color')->name('destroy_color');
	Route::post('update_foto/{id}', 'ProductController@editImage')->name('update_image');
	Route::post('add_foto/{id}', 'ProductController@addImage')->name('add_image');
	Route::get('delete_foto/{id}', 'ProductController@deleteImage')->name('delete_image');
	Route::get('activated_product/{id}', 'ProductController@activated_product')->name('activated_product');

	//Slide
	Route::get('slide', 'SlideController@index')->name('slide');
	Route::get('datatable_slide', 'SlideController@DataTableSlide')->name('datatable_slide');
	Route::get('create_slide', 'SlideController@create')->name('create_slide');
	Route::get('detail_slide/{id}', 'SlideController@show')->name('detail_slide');
	Route::get('edit_slide/{id}', 'SlideController@edit')->name('edit_slide');
	Route::post('store_slide', 'SlideController@store')->name('store_slide');
	Route::post('update_slide/{id}', 'SlideController@update')->name('update_slide');
	Route::get('delete_slide/{id}', 'SlideController@destroy')->name('delete_slide');

	//Banner
	Route::get('banner', 'BannerController@index')->name('banner');
	Route::get('datatable_banner', 'BannerController@DataTableBanner')->name('datatable_banner');
	Route::get('edit_banner/{id}', 'BannerController@edit')->name('edit_banner');
	Route::post('update_banner/{id}', 'BannerController@update')->name('update_banner');

	//About
	Route::get('about', 'AboutController@index')->name('about');
	Route::get('datatable_about', 'AboutController@DataTableAbout')->name('datatable_about');
	Route::get('edit_about/{id}', 'AboutController@edit')->name('edit_about');
	Route::post('update_about/{id}', 'AboutController@update')->name('update_about');

	//Contact
	Route::get('contact', 'ContactController@index')->name('contact');
	Route::get('edit_contact/{id}', 'ContactController@edit')->name('edit_contact');
	Route::post('update_contact/{id}', 'ContactController@update')->name('update_contact');

	//Baccount
	Route::get('bank-account', 'BaccountController@index')->name('bank-account');
	Route::get('datatable_baccount', 'BaccountController@DataTableBaccount')->name('datatable_baccount');
	Route::get('create-bank-account', 'BaccountController@create')->name('create_baccount');
	Route::get('edit-bank-account/{id}', 'BaccountController@edit')->name('edit-bank-account');
	Route::post('store_baccount', 'BaccountController@store')->name('store_baccount');
	Route::post('update_baccount/{id}', 'BaccountController@update')->name('update_baccount');
	Route::get('delete_baccount/{id}', 'BaccountController@destroy')->name('delete_baccount');

	//Profile
	Route::get('profile', 'ProfileController@index')->name('profile');
	Route::get('profile/edit', 'ProfileController@edit')->name('profile_edit');
	Route::post('profile_update', 'ProfileController@update')->name('profile_update');
});

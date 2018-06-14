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


//Pages
Route::get('homepage','PagesController@homepage');
Route::get('category/{id}','PagesController@category');
Route::get('brand/{id}','PagesController@brand');
Route::get('detail/{id}','PagesController@detail');
Route::post('search','PagesController@search');
Route::get('login','PagesController@getLogin');
Route::post('login','PagesController@postLogin');
Route::get('signup','PagesController@getSignup');
Route::post('signup','PagesController@postSignup');
Route::get('logout','PagesController@getLogout');
Route::get('profile','PagesController@getProfile');
Route::post('profile','PagesController@postProfile');
Route::get('orderList','PagesController@getOrderList');
Route::get('cart','PagesController@getCart');
Route::get('addtoCart/{id}','PagesController@getaddtoCart');
Route::get('updateCart/{id}/{qty}','PagesController@updateCart');
Route::get('removefromCart/{id}','PagesController@removefromCart');
Route::get('order','PagesController@getOrder');
Route::post('shipping','PagesController@shipping');
Route::get('order_complete','PagesController@getOrderComplete');
Route::post('comment/{id}','PagesController@comment');
Route::post('message','PagesController@message');

Route::get('admin/login','AdminConTroller@getAdminLogin');
Route::post('admin/login','AdminConTroller@postAdminLogin');
Route::get('admin/logout','AdminConTroller@getAdminLogout');



Route::group(['prefix'=>'admin','middleware'=>'admin'],function(){

    Route::get('dashboard',function(){
      return view('admin.layout.dashboard');
    });
    Route::group(['prefix'=>'type_product'],function(){
    Route::get('list','TypeController@getList');
    Route::get('add','TypeController@getAdd');
    Route::post('add','TypeController@postAdd');
    Route::get('edit/{id}','TypeController@getEdit');
    Route::post('edit/{id}','TypeController@postEdit');
    Route::get('delete/{id}','TypeController@getDelete');
  });
  Route::group(['prefix'=>'brand'],function(){
    Route::get('list','BrandController@getList');
    Route::get('add','BrandController@getAdd');
    Route::post('add','BrandController@postAdd');
    Route::get('edit/{id}','BrandController@getEdit');
    Route::post('edit/{id}','BrandController@postEdit');
    Route::get('delete/{id}','BrandController@getDelete');
  });
  Route::group(['prefix'=>'product'],function(){
    Route::get('list','ProductController@getList');
    Route::get('add','ProductController@getAdd');
    Route::post('add','ProductController@postAdd');
    Route::get('edit/{id}','ProductController@getEdit');
    Route::post('edit/{id}','ProductController@postEdit');
    Route::get('delete/{id}','ProductController@getDelete');
  });
  Route::group(['prefix'=>'provider'],function(){
    Route::get('list','ProviderController@getList');
    Route::get('add','ProviderController@getAdd');
    Route::post('add','ProviderController@postAdd');
    Route::get('edit/{id}','ProviderController@getEdit');
    Route::post('edit/{id}','ProviderController@postEdit');
    Route::get('delete/{id}','ProviderController@getDelete');
  });
  Route::group(['prefix'=>'input_sheet'],function(){
    Route::get('providerChoose','InputSheetController@getProviderChoose');
    Route::get('productList','InputSheetController@getProductList');
    Route::get('add/{id}','InputSheetController@getAdd');
    Route::post('add/{id}','InputSheetController@postAdd');
    Route::get('list','InputSheetController@getList');
  });
  Route::group(['prefix'=>'user'],function(){
    Route::get('list','UserController@getList');
    Route::get('add','UserController@getAdd');
    Route::post('add','UserController@postAdd');
    Route::get('edit/{id}','UserController@getEdit');
    Route::post('edit/{id}','UserController@postEdit');
    Route::get('delete/{id}','UserController@getDelete');
  });
  Route::group(['prefix'=>'bill'],function(){
    Route::get('list','BillController@getList');
    Route::get('detail/{id}','BillController@getDetail');
  });
});

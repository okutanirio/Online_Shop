<?php

use App\product;

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

Route::get('/', function () {
    $product = new Product;
    $all = $product->orderBy('created_at', 'desc')->take(8)->get();
    return view('home', [
        'products' => $all, 
    ]);
});

Route::get('/home', 'HomeController@index')->name('home');

//ログイン・ログアウト・新規登録（認証回り）
Auth::routes();

//管理者
Route::get('admin', 'AdminController@index')->name('admin');
Route::get('admin/product', 'ProductController@index')->name('products');
//商品登録
Route::get('admin/create_product', 'ProductController@create')->name('create.product');
Route::post('admin/create_product', 'ProductController@store');
//商品編集
Route::get('admin/edit_product/{product}', 'ProductController@edit')->name('edit.product');
Route::post('admin/edit_product/{product}', 'ProductController@update');
//商品削除
Route::get('admin/productdelete/{product}', 'ProductController@destroy')->name('product.delete');
//商品詳細
Route::get('/product/detail_product/{product}', 'ProductController@show')->name('detail.product');

//カート
Route::get('/product/cart/{product}', 'ProductController@cart')->name('cart');
Route::get('/product/cartdelete/{id}', 'ProductController@cartdelete')->name('cart.delete');
Route::get('/product/cartlist', 'ProductController@cartlist')->name('cart.list');
//注文
Route::get('/product/order_conf', 'ProductController@orderconf')->name('order.conf');
Route::get('/product/order_conp', 'ProductController@orderconp')->name('order.conp');

//一般ユーザ
Route::get('/users/mypage/{id}', 'UserController@index')->name('mypage');
//購入履歴
Route::get('/users/purchase_list', 'UserController@purchaselist')->name('purchase.list');

//category
Route::get('/accessory/pierce', 'ProductController@pierce')->name('pierce');
Route::get('/accessory/necklace', 'ProductController@necklace')->name('necklace');
Route::get('/accessory/ring', 'ProductController@ring')->name('ring');
Route::get('/accessory/bracelet', 'ProductController@bracelet')->name('bracelet');

//検索
Route::get('/product/search', 'ProductController@result')->name('search');

//お気に入り
Route::post('ajaxlike', 'ProductController@ajaxlike');
Route::get('/product/likelist', 'ProductController@likelist')->name('like.list');


//ユーザ編集
Route::get('/users/edit_user/{id}', 'UserController@edit')->name('edit.user');
Route::post('users/edit_user/{id}', 'UserController@update');


//パスワードリセット
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset/{token}', 'Auth\ResetPasswordController@reset');

//Route::resource('products', 'ProductController');


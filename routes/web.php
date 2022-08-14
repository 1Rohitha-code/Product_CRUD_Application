<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('/warning', function () {
    return view('warning_msg');
});

// Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', function () {
    return view('landing_page');
});

Route::get('/my_register', function () {
    return view('myregister');
});

Auth::routes();

//Administrator routes
Route::group(['middleware' => ['auth','isAdmin']], function () {

    Route::get('/admin_dashboard', 'AdminController@index');
    Route::get('/product_list', 'ProductController@show_list');
    Route::get('/create_form', 'ProductController@create_product');
    Route::post('/save_form', 'ProductController@store_form_data');
    
    Route::get('/cat_data_insertion_form', 'ProductController@display_cat_form');
    Route::post('/store_cat_data_form', 'ProductController@store_cat_form');
    Route::get('/edit_cat_data_form/{id}', 'ProductController@edit_cat_form');
    Route::post('/update_cat_data_form/{prod_cat_id}', 'ProductController@update_cat_form');
    Route::delete('/delete_cat_data_form/{id}', 'ProductController@delete_cat_form');
    Route::get('/single_prod_data/{prod_cat_id}', 'ProductController@show_prod_data');
    Route::get('/get_variant_data/{id}', 'ProductController@show_variant');
    Route::get('/edit_page/{id}', 'ProductController@editable_data');
    Route::post('/updating_prod_data/{id}', 'ProductController@update_prod_data');
    Route::delete('/delete_product/{id}', 'ProductController@delete_product');
});

//Customer routes
Route::group(['middleware' => ['auth','isCustomer']], function () {

    Route::get('/customer_dashboard', 'CustomerController@index');

});

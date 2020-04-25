<?php

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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/welcome', 'HomeController@welcome')->name('welcome');
Route::get('/item/new', 'ItemController@new')->name('item-new');
Route::get('/item/show/{item_id}', 'ItemController@show')->name('item-show');
Route::get('/item/edit/{item_id}', 'ItemController@edit')->name('item-edit');
Route::get('/item/approvals', 'ApprovalController@pending_approvals')->name('item-approvals');
Route::get('/item/approve/{item_id}', 'ApprovalController@approve_item')->name('item-approve');
Route::get('/item/deny/{item_id}', 'ApprovalController@deny_item')->name('item-deny');
Route::get('/item/request/{item_id}', 'ItemController@request_item')->name('item-request');
Route::get('/item/request/approve/{item_id}', 'ApprovalController@approve_request')->name('item-request-approve');
Route::get('/item/request/deny/{item_id}', 'ApprovalController@deny_request')->name('item-request-deny');
Route::get('/item/requests', 'ApprovalController@pending_requests')->name('item-requests');
Route::post('/item/create_request', 'ItemController@create_request')->name('item-create_request');
Route::post('/item/create', 'ItemController@create')->name('item-create');
Route::post('/item/update/{item_id}', 'ItemController@update')->name('item-update');
Route::post('/item/update/add_photo/{item_id}', 'ItemController@add_photo')->name('item-add_photo');
Route::post('/item/update/change_photo/{item_id}/{image_id}', 'ItemController@change_photo')->name('item-change_photo');




// Route::view('/{path?}', 'app');

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


Route::group(['prefix' => 'api/v1'], function () {
  Route::get('item/add', '\TestLaravel\Items\ApiItemsController@add');

  Route::post('item/add', '\TestLaravel\Items\ApiItemsController@save')->name('ApiItemAdd');

  Route::get('item/show/{slug}', '\TestLaravel\Items\ApiItemsController@showItem')->name('APiItemSlug');

  Route::get('item/show-by-id/{id}', '\TestLaravel\Items\ApiItemsController@showItemById')->name('APiItemId');

  Route::get('item/all', '\TestLaravel\Items\ApiItemsController@index')->name('ApiAllItems');

  Route::post('item/set-ratings',  '\TestLaravel\Items\ApiItemsController@setItemsRating')->name('ApiItemsSetRatings');

  Route::post('item/set-rating-one-item',  '\TestLaravel\Items\ApiItemsController@setRatingForOneItem')->name('ApiOnrItemsSetRating');


});
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
  Route::get('item/add', '\Test\Items\ApiItemsController@add');

  Route::post('item/add', '\Test\Items\ApiItemsController@save')->name('ApiItemAdd');

  Route::get('item/show/{slug}', '\Test\Items\ApiItemsController@showItem')->name('APiItemSlug');

  Route::get('item/show-by-id/{id}', '\Test\Items\ApiItemsController@showItemById')->name('APiItemId');

  Route::get('item/all', '\Test\Items\ApiItemsController@index')->name('ApiAllItems');

  Route::post('item/set-ratings',  '\Test\Items\ApiItemsController@setItemsRating')->name('ApiItemsSetRatings');

  Route::post('item/set-rating-one-item',  '\Test\Items\ApiItemsController@setRatingForOneItem')->name('ApiOnrItemsSetRating');


});
<?php

Route::group(['middleware' => 'web'], function () {
  Route::get('/', '\TestLaravel\Items\ItemsController@index');

  Route::get('item/add', '\TestLaravel\Items\ItemsController@add')->name('itemAddPage');

  Route::post('item/add', '\TestLaravel\Items\ItemsController@save')->name('itemAdd');

  Route::get('item/show/{slug}', '\TestLaravel\Items\ItemsController@showItem')->name('itemSlug');

  Route::get('item/all', '\TestLaravel\Items\ItemsController@index')->name('allItems');
});
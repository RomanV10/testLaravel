<?php

Route::group(['middleware' => 'web'], function () {
  Route::get('/', '\Test\Items\ItemsController@index');

  Route::get('item/add', '\Test\Items\ItemsController@add')->name('itemAddPage');

  Route::post('item/add', '\Test\Items\ItemsController@save')->name('itemAdd');

  Route::get('item/show/{slug}', '\Test\Items\ItemsController@showItem')->name('itemSlug');

  Route::get('item/all', '\Test\Items\ItemsController@index')->name('allItems');
});
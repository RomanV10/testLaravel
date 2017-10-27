<?php

namespace TestLaravel\Items;

use Illuminate\Support\ServiceProvider;
use Psy\CodeCleaner\AbstractClassPass;

class ItemsServiceProvider extends ServiceProvider
{
  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  public function boot()
  {
    require __DIR__.'/routes/web.php';
    require __DIR__.'/routes/api.php';


    $this->loadViewsFrom(__DIR__.'/layouts', 'items');

    $this->loadViewsFrom(__DIR__.'/views', 'items');

    $this->publishes([
      __DIR__.'/migrations/2017_10_23_061251_test_items.php' => base_path('database/migrations/2017_10_23_061251_test_items.php'),
    ]);
  }

  /**
   * Register any application services.
   *
   * @return void
   */
  public function register()
  {
    $this->app->bind('items', function ($app) {
      return new AbstractItemsController;
    });

    $this->app->bind('items', function ($app) {
      return new ItemsController;
    });

    $this->app->bind('items', function ($app) {
      return new ApiItemsController;
    });
  }
}

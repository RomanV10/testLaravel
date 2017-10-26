<?php

namespace Test\Items;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
  public $timestamps = false;
  protected $fillable = ['item_id'];

  public static function boot()
  {
    parent::boot();

    /**
     * We don't need create field for this model. Only "updated_at".
     */
    static::creating(function ($model) {
      $model->updated_at = $model->freshTimestamp();
    });
  }
}

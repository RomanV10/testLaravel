<?php

namespace TestLaravel\Items;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use TestLaravel\Items\ItemsController;
class Items extends Model {

  protected $fillable = ['title', 'slug', 'image_path'];

  /**
   * @param $slug
   * @param int $id
   * @return mixed
   */
  public function getRelatedSlugs(string $slug, $id = 0) {
    return $this::select('slug')->where('slug', 'like', $slug . '%')
      ->where('id', '<>', $id)
      ->get();
  }

  /**
   * @param $data
   * @return int
   */
  public function saveItem($data) {
    if ($this->fill($data)->save()) {
      (new Rate)->fill(['item_id' => $this->id])->save();
      return $this->id;
    }

    return 0;
  }

  /**
   * @param $slug
   * @return mixed
   */
  public function getItemById(int $id) {
    return DB::table('items')
      ->join('rates', 'items.id', '=', 'rates.item_id')
      ->orderBy('rate', 'DESC')
      ->select('items.*', 'rate')
      ->where('id', $id)
      ->get();
  }


  /**
   * @param $slug
   * @return mixed
   */
  public function getItemIdBySlug(string $slug) {
    return $this::select('id')
      ->where('slug', '=', $slug)
      ->first();
  }

  /**
   * @param $slug
   * @return mixed
   */
  public function getItemBySlug(string $slug) {
    return $this::select('*')
      ->where('slug', '=', $slug)
      ->first();
  }

  /**
   * @param int $items_number
   * @return mixed
   */
  public function getLastPopularItems(int $items_number = 2) {
    return DB::table('items')
      ->join('rates', 'items.id', '=', 'rates.item_id')
      ->orderBy('rate', 'DESC')
      ->take($items_number)
      ->select('items.*', 'rate')
      ->get();
  }

  /**
   * @param int $items_number
   * @return mixed
   */
  public function getRandomItems(int $items_number = 2) {
    return DB::table('items')
      ->join('rates', 'items.id', '=', 'rates.item_id')
      ->take($items_number)
      ->select('items.*', 'rate')
      ->inRandomOrder()
      ->get();
  }

}

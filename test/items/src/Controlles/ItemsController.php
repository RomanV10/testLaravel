<?php

namespace Test\Items;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Test\Items\AbstractItemController;

class ItemsController extends AbstractItemController {

  /**
   * Get all item.
   *
   * By default show 2 item with biggest rates. If exist param "random" show random items.
   *
   * @return \Illuminate\Contracts\View\View
   */
  public function index() {
    $items = parent::index();
    $items_ids_string = $this->buildItemsIdsQueryString($items);
    return view('items::index')->with(['items' => $items, 'items_ids' => $items_ids_string]);
  }


  /**
   * Set rate for item when clicked to his url.
   *
   * @param $slug
   * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
   */
  public function showItem($slug) {
    $items = new Items();
    if ($item = $items->getItemIdBySlug($slug)) {
      $items_ids = $this->buildItemsIdsFromQueryString();
      $item_id = $item->id;

      $this->setItemsRating($item_id, $items_ids);
    }
   return redirect()->route('allItems', ['random' => 1]);

  }


  /**
   * @return \Illuminate\Contracts\View\View
   */
  public function add() {
    return parent::add();
  }

  /**
   * @param \Illuminate\Http\Request $request
   * @return \Illuminate\Contracts\View\View
   */
  public function save(Request $request) {
    $this->validate($request, $this->rulesValidation);
    try {

      if ($request->hasFile('image')) {
        $file_name = $this->saveFile($request);
        $data['image_path'] = $file_name;
      }

      $items = new Items();

      $data['title'] = $request->input('title');
      $data['slug'] = $this->createSlug($items, $data['title']);

      $items->saveItem($data);
      return redirect()->route('allItems', ['random' => 1]);
    }
    catch (\Exception $e) {
      return $e;
    }

  }


  /**
   * @return array
   */
  public function buildItemsIdsFromQueryString() : array {
    $items_ids = array();

    if (Input::has('items_ids')) {
      $items_ids = explode(',', Input::only('items_ids')['items_ids']);
    }

    return $items_ids;
  }



}

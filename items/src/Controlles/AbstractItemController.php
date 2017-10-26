<?php

namespace TestLaravel\Items;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\URL;
abstract class AbstractItemController extends Controller {
  public $random = FALSE;
  public $imageDirectory = '/images';
  protected $rulesValidation = [
    'title' => 'required|max:255',
    'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
  ];


  /**
   * Get all item.
   *
   * By default show 2 item with biggest rates. If exist param "random" show random items.
   *
   * @return \Illuminate\Contracts\View\View
   */
  public function index() {
    $item_inst = new Items();

    if (Input::has('random') && Input::only('random')['random'] == '1') {
      $items = $item_inst->getRandomItems();
    }
    else {
      $items = $item_inst->getLastPopularItems();
    }
    $items = $this->buildImageUrlForItems($items);

    return $items;
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
    return view('items::add-item');
  }

  /**
   * @param \Illuminate\Http\Request $request
   * @return \Illuminate\Contracts\View\View
   */
  public function save(Request $request) {

    $this->validate($request, $this->rulesValidation);

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


  /**
   * @param \Illuminate\Http\Request $request
   * @return string
   */
  public function saveFile(Request $request) {
    $image = $request->file('image');
    $image_name = time() . '.' . $image->getClientOriginalExtension();

    $destinationPath = public_path($this->imageDirectory);

    $image->move($destinationPath, $image_name);
    return $this->imageDirectory.'/'.$image_name;
  }

  /**
   * @param $title
   * @param int $id
   * @return string
   * @throws \Exception
   */
  public function createSlug(Items $items, $title, $id = 0) {
    $slug = str_slug($title);
    $allSlugs = $items->getRelatedSlugs($slug, $id);

    if (!$allSlugs->contains('slug', $slug)) {
      return $slug;
    }

    // Numbers like a savage until we find not used.
    for ($i = 1; $i <= 10; $i++) {
      $newSlug = $slug . '-' . $i;
      if (!$allSlugs->contains('slug', $newSlug)) {
        return $newSlug;
      }
    }

    throw new \Exception('Can not create a unique slug');
  }

  /**
   * @param  Collection $items
   *
   * @return string
   */
  public function buildItemsIdsQueryString($items) : string {
    $string_ids = '';

    foreach ($items as $item) {
      $ids[] = $item->id;
    }

    if (!empty($ids)) {
      $string_ids = implode(',',$ids);
    }

    return $string_ids;
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

  /**
   * Set rate votes for items form the page.
   *
   * @param int $selected_id
   *   Item if that was clicked.
   * @param array $all_ids
   *   Array of all items for the page.
   */
  public function setItemsRating(int $selected_id, array $all_ids) {
    $this->setRatingForOneItem($selected_id, 1);

    $all_ids = array_flip($all_ids);
    unset($all_ids[$selected_id]);

    if (!empty($all_ids)) {
      foreach ($all_ids as $id => $val) {
        $this->setRatingForOneItem($id, -1);
      }
    }

  }

  /**
   * Set vote for one item.
   *
   * @param int $item_id
   *   Id of the item.
   * @param int $rating
   *   Rate. Can be with minus. Example 1 or -1.
   */
  public function setRatingForOneItem(int $item_id, int $rating) {
    Rate::where('item_id', $item_id)->increment('rate', $rating);
  }

  public function buildImageUrlForItems($items) {
    foreach ($items as $item) {
      $http_check = strpos($item->image_path, 'http:');
      if ($http_check === FALSE) {
        $item->image_path = URL::to('/') . $item->image_path;
      }
      $new_items[] = $item;
    }
    return !empty($new_items) ? $new_items : $items;
  }


}

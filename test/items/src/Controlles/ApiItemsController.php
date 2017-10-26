<?php

namespace Test\Items;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
class ApiItemsController extends AbstractItemController {
  protected $rulesValidation = [
    'title' => 'required|max:255',
    'image_path' => 'required|max:255',
  ];

  protected $ratingValidation = [
    'id' => 'required',
  ];

  /**
   * Get all item.
   *
   * By default show 2 item with biggest rates. If exist param "random" show random items.
   *
   */
  public function index() {
    return parent::index();
  }


  public function save(Request $request) {
    try {
      $validator = Validator::make($request->all(), $this->rulesValidation);

      if ($validator->fails()) {
        return $error = $validator->messages()->toJson();
      }

      $items = new Items();

      $data['title'] = $request->input('title');
      $data['image_path'] = $request->input('image_path');
      $data['slug'] = $this->createSlug($items, $data['title']);

      $items->saveItem($data);
      return $this->buildImageUrlForItems(array($items));
    }
    catch (\Exception $e) {
      return $e;
    }
  }

  /**
   * Set rate for item when clicked to his url.
   *
   * @param $slug
   * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
   */
  public function showItem($slug) {
    $items = (new Items())->getItemBySlug($slug);
    if (!empty($items)) {
      return $items = $this->buildImageUrlForItems(array($items));
    }
  }

  /**
   * Set rate for item by id.
   *
   * @param int $id
   * @return array
   */
  public function showItemById(int $id) {
    $items = (new Items())->getItemById($id);
    if (!empty($items)) {
      return $items = $this->buildImageUrlForItems($items);
    }
    return array();
  }

  /**
   * Set rate votes for items form the page.
   *
   * @param int $selected_id
   *   Id of chosen item.
   * @param array $all_ids
   *   Ids on not chosen items.
   *
   * @return array
   *   Two more popular items.
   */
  public function setItemsRating(int $selected_id = 0, array $all_ids = array()) {
    try {
      $validator = Validator::make(Input::all(), $this->ratingValidation);

      if ($validator->fails()) {
        return $error = $validator->messages()->toJson();
      }

      $selected_id = Input::only('id')['id'];
      $this->setRatingForOneItem($selected_id, 1);

      if (Input::has('other_ids')) {
        $all_ids = Input::only('other_ids')['other_ids'];

        $all_ids = array_flip($all_ids);
        if (isset($all_ids[$selected_id])) {
          unset($all_ids[$selected_id]);
        }

        if (!empty($all_ids)) {
          foreach ($all_ids as $id => $val) {
            $this->setRatingForOneItem($id, -1);
          }
        }
      }

      return $this->index();
    }
    catch (\Exception $e) {
      return $e;
    }
  }

  /**
   * Set vote for one item.
   *
   * @param int $item_id
   *   Item id.
   * @param int $rating
   *   Rate number.
   *
   * @return mixed
   *   Json array with item info.
   */
  public function setRatingForOneItem(int $item_id = 0, int $rating = 0) {
    try {
      $validator = Validator::make(Input::all(), $this->ratingValidation);

      if ($validator->fails()) {
        return $error = $validator->messages()->toJson();
      }

      $item_id = Input::only('id')['id'];
      $rating = Input::only('rating')['rating'];

      Rate::where('item_id', $item_id)->increment('rate', $rating);

      return $this->showItemById($item_id);
    }
    catch (\Exception $e) {
      return $e;
    }
  }


}

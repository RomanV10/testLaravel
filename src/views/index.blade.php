@extends('items::main')

@section('content')
    <div class="row span6 text-center">
        <button>{{link_to_route('allItems', 'PLay', ['random' => 1])}}</button>
        <button>{{link_to_route('itemAdd', 'Add new Item')}}</button>
    </div>
    @foreach($items as $item)
        <div class="row span6 text-center">
            <a href="{{route('itemSlug',[$item->slug, 'items_ids' => $items_ids])}}"><img width="50%"
                                                                                          src="{{ $item->image_path }}"></a>
            <p class="span6">{{link_to_route('itemSlug', $item->title, [$item->slug, 'items_ids' => $items_ids])}}</p>
            <p class="span6">Votes:{{$item->rate}}</p>
        </div>
        <hr>
    @endforeach
@endsection


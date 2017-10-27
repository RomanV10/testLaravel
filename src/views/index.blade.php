@extends('items::main')

@section('content')
        <div class="row span6 top-wrap">
            <div class="left-side">
                <a href="/">
                    <p class="font-16px grey-font">Wars</p>
                    <p class="font-24px">Highscore</p>
                </a>
            </div>
            <div class="right-side">
                <button>{{link_to_route('allItems', 'Play', ['random' => 1])}}</button>
                <button>{{link_to_route('itemAdd', 'Add new Item')}}</button>
            </div>
        </div>
        <div class="center-wrap">
            @foreach($items as $item)
                <div class="row span6 text-center">
                    <a class="block-item row" href="{{route('itemSlug',[$item->slug, 'items_ids' => $items_ids])}}">
                        <div class="block-wrap row">
                            <div class="left-side">
                                <p class="font-30px">{{ $item->title }}</p>
                                <p class="font-18px grey-font">{{ $item->second_title }}</p>
                                <p class="font-18px color-pink">{{$item->rate}} vote(s)</p>

                            </div>
                            <div class="right-side width-40pt">
                                <img width="100%" src="{{ $item->image_path }}">
                            </div>
                        </div>
                        @if ($item->rate > 0)
                        <div class="vote-line" style="width: {{$item->rate}}%;"></div>
                        @endif
                    </a>
                </div>
            @endforeach
        </div>
@endsection

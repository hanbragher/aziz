<div class="collection">
    <a href="{{route('places.index', ['place'=>'all'])}}" class="collection-item @if($active == 'all') active @endif ">All</a>
    @foreach(\Azizner\Category::all()->pluck('name') as $category)
        <a href="{{route('places.index', ['place'=>$category])}}" class="collection-item @if($active == $category) active @endif ">{{$category}}</a>
    @endforeach
</div>
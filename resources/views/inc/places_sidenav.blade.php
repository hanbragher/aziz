<div class="collection">
    <a href="{{route('places.index', ['place'=>'all'])}}" class="collection-item @if($active == 'all') active @endif ">All</a>
    @foreach(\Azizner\Group::all() as $group)
        <a href="{{route('places.index', ['place'=>$group->name])}}" class="collection-item @if($active == $group->name) active @endif ">{{$group->name}}</a>
    @endforeach
</div>
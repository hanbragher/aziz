<div class="collection">
    <a href="{{route('places.index', ['place'=>'all'])}}" class="collection-item @if($active == 'all') active @endif ">All</a>
    <a href="{{route('places.index', ['place'=>'vanq'])}}" class="collection-item @if($active == 'vanq') active @endif ">Vanq</a>
    <a href="{{route('places.index', ['place'=>'ekexeci'])}}" class="collection-item @if($active == 'ekexeci') active @endif ">Ekexeci</a>
    <a href="{{route('places.index', ['place'=>'xanut'])}}" class="collection-item @if($active == 'xanut') active @endif ">Xanut</a>
    <a href="{{route('places.index', ['place'=>'restoran'])}}" class="collection-item @if($active == 'restoran') active @endif ">Restoran</a>
    <a href="{{route('places.index', ['place'=>'aygi'])}}" class="collection-item @if($active == 'aygi') active @endif ">Aygi</a>
</div>
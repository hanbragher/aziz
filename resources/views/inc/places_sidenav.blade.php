<div class="collection">
    <a href="{{route('places.index', ['places'=>'all'])}}" class="collection-item @if($active == 'all') active @endif ">All</a>
    <a href="{{route('places.index', ['places'=>'vanq'])}}" class="collection-item @if($active == 'vanq') active @endif ">Vanq</a>
    <a href="{{route('places.index', ['places'=>'ekexeci'])}}" class="collection-item @if($active == 'ekexeci') active @endif ">Ekexeci</a>
    <a href="{{route('places.index', ['places'=>'xanut'])}}" class="collection-item @if($active == 'xanut') active @endif ">Xanut</a>
    <a href="{{route('places.index', ['places'=>'restoran'])}}" class="collection-item @if($active == 'restoran') active @endif ">Restoran</a>
    <a href="{{route('places.index', ['places'=>'aygi'])}}" class="collection-item @if($active == 'aygi') active @endif ">Aygi</a>
</div>
<div class="collection">
    <a href="{{route('adminplaces.index')}}" class="collection-item @if($active == 'places') active @endif "><i class="material-icons">assistant_photo</i> Places</a>

    <p class="collection-item sidenav-divader"></p>
    <a href="{{route('categories.index')}}" class="collection-item @if($active == 'categories') active @endif "><i class="material-icons">collections_bookmark</i> Categories</a>

    <p class="collection-item sidenav-divader"></p>
    <a href="{{route('users.index')}}" class="collection-item @if($active == 'users') active @endif "><i class="material-icons">people</i> Users</a>

</div>
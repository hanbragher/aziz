<div class="col s12">
    <ul class="tabs">
        <li class="tab col s4"><a target="_self" class="{{($active == 'photos')?'active':''}}" href="{{route('favorites.index', ['photos'])}}">photos</a></li>
        <li class="tab col s4"><a target="_self" class="{{($active == 'announcements')?'active':''}}" href="{{route('favorites.index', ['announcements'])}}">announcements</a></li>
        <li class="tab col s4"><a target="_self" class="{{($active == 'places')?'active':''}}" href="{{route('favorites.index', ['places'])}}">places</a></li>
    </ul>
</div>
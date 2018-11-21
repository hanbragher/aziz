<div class="col s12">
    <ul class="tabs">
        <li class="tab col s6"><a target="_self" class="{{($active == 'photos')?'active':''}}" href="{{route('favorites.index', ['photos'])}}">photos</a></li>
        <li class="tab col s6"><a target="_self" class="{{($active == 'announcements')?'active':''}}" href="{{route('favorites.index', ['announcements'])}}">announcements</a></li>
    </ul>
</div>
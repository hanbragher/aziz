<div class="col s12">
    <ul class="tabs">
        <li class="tab col s4"><a target="_self" class="{{($active == 'all')?'active':''}}" href="{{route('users.index', ['all'])}}">All</a></li>
        <li class="tab col s4"><a target="_self" class="{{($active == 'admins')?'active':''}}" href="{{route('users.index', ['admins'])}}">Admins</a></li>
        <li class="tab col s4"><a target="_self" class="{{($active == 'creators')?'active':''}}" href="{{route('users.index', ['creators'])}}">Creators</a></li>
    </ul>
</div>
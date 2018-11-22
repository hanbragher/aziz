<div class="col s12">
    <ul class="tabs">
        <li class="tab col s6"><a target="_self" class="{{($active == 'overview' )?'active':''}}" href="{{route('profiles.my')}}">Overview </a></li>
        <li class="tab col s6"><a target="_self" class="{{($active == 'notifications')?'active':''}}" href="{{route('notifications.index')}}">Notifications @if($user->hasNewNotification()) <i class="material-icons tiny">priority_high</i> @endif</a></li>
    </ul>
</div>
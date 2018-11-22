<div class="card">
    <div class="card-content notification ">
        <span class="truncate">
            <a href="{{route('profiles.show', $notification->from->id )}}" class="grey-text" target="_blank">{{$notification->from->first_name}} {{$notification->from->last_name}} <i class="material-icons tiny">open_in_new</i>
                | {{$notification->created_at}}</a>
            @if(!$notification->is_read)
                <i class="secondary-content material-icons right">fiber_new</i>
            @endif
        </span>
        <div class="divider"></div>
        <h6 >{!!$notification->text!!}</h6>
    </div>
</div>
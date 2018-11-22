<div class="card">
    <div class="card-content comment">
        <span class="truncate grey-text">Author: <a href="{{route('profiles.show', $comment->user->id )}}" class="black-text" target="_blank">{{$comment->user->first_name}} {{$comment->user->last_name}} <i class="material-icons tiny">open_in_new</i></a></span>
        <p class="truncate grey-text">Date: {{$comment->created_at}}</p>
        <div class="divider"></div>

        <h6>{!!$comment->comment!!}</h6>

        <a data-actionroute='{{route('comments.destroy', $comment->id)}}' class="modal-open-delete btn-floating halfway-fab waves-effect waves-light " ><i class="material-icons red">delete_forever</i></a>

    </div>
        {{--<div class="card-action">
        </div>--}}
</div>
<div class="card">
    <div class="card-content card-notes">
        <span class="truncate">
            @if($editable == false)
                @if(!empty($guest) and $guest == true)
                    <p>
                    From: <a href="{{route('places.show', $note->place->id)}}" class="black-text" target="_blank">{{$note->place->category->name}} | {{$note->place->name}} <i class="material-icons tiny">open_in_new</i></a>
                    </p>
                @else
                    Author: <a href="{{route('profiles.show', $note->user->id )}}" class="black-text" target="_blank">{{$note->user->first_name}} {{$note->user->last_name}} <i class="material-icons tiny">open_in_new</i></a>
                @endif
            @else
                <a href="{{route('places.show', $note->place->id )}}" class="black-text" target="_blank">{{$note->place->name}} <i class="material-icons tiny">open_in_new</i></a>
            @endif
                Date: {{$note->created_at}}
        </span>

        <hr>
        <p>{{$note->text}}</p>
        @if($note->images->first())
            @foreach($note->images as $image)
                <a href="{{$image->file}}" class="notes-big">
                    <img src="{{$image->thumb}}" alt="" >
                </a>
            @endforeach
        @endif
    </div>
    @if($editable == true)
        <div class="card-action">
            <form action="#">
                <a href="{{route('notes.edit', $note->id)}}" >Edit</a>
                <a href='#' data-actionroute='{{route('notes.destroy', $note->id)}}' class="modal-open-delete">Remove</a>
            </form>
        </div>
    @endif
</div>
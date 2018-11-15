<li class="collection-item avatar">

    <a href="{{route('messages.show', $id)}}"><img src="{{$avatar}}" alt="" class="circle"></a>
    <a href="{{route('messages.show', $id)}}" class="black-text"><span class="title">{{$show}}: {{$name}}</span></a>
    <p class="truncate">Title: {{$title}}</p>
    <p>Time: {{$time}}
        @if($hasAttachments)
            <i class="material-icons tiny">attach_file</i>
        @endif
    </p>
    @if($show == 'from' and !$is_read)
        <i class="secondary-content material-icons right">fiber_new</i>
    @endif

    <a data-messageaction='{{route('messages.destroy', $id)}}' class="modal-open-delete grey-text btn-flat modal-trigger">delete</a>


</li>

<div class="card small">
    <div class="row card-content margin-bottom-0">

        <a href="{{route('announcements.show', $announcement->id)}}" >
            <img src="{{$announcement->thumb}}"
                       height="190"
                       align="left"
                       vspace="5"
                       hspace="5">
        </a>



        @if(!empty($star) and $star == true)
            <a href="#!" class="secondary-content right"><i class="material-icons orange-text">star</i></a>
        @else
            <a href="#!" class="secondary-content right"><i class="material-icons orange-text">star_border</i></a>
        @endif

        <p class="flow-text center truncate"><a href="{{route('announcements.show', $announcement->id)}}">{{$announcement->title}}</a></p>
        <p class="truncate">{{$announcement->text}}</p>
        <p class="truncate">Date: {{$announcement->created_at}}</p>
        <p>

            @if(!empty($announcement->tags))
                @foreach($announcement->tags as $tag)
                    <a class="chip" href="{{route('announcements.index', ['tag'=>$tag->name])}}">{{$tag->name}}</a>
                @endforeach

            @endif

        </p>


    </div>
    <div class="card-action">
        @if(!empty($editable) and $editable == true)
            <a href="{{route('announcements.edit', $announcement->id)}}" >Edit</a>
            <a href="{{route('announcements.show', $announcement->id)}}" >show</a>

            <a data-announcementaction='{{route('announcements.destroy', $announcement->id)}}'  class="modal-open-delete btn-floating halfway-fab waves-effect waves-light red"  ><i class="material-icons">delete_forever</i></a>

        @else
            <a href="{{route('announcements.show', $announcement->id)}}">show more</a>
            <a href="{{route('announcements.show', $announcement->id)}}#modal-reply">reply</a>
        @endif

    </div>
</div>




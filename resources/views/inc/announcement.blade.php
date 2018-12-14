<div class="card small">
    <div class="row card-content margin-bottom-0">

            <a href="{{route('announcements.show', $announcement->id)}}" {{--class="hide-on-small-only"--}}>
                <img src="{{$announcement->thumb}}" class="announcement-card-image">
            </a>

        @if($starable === true)
            @auth
                <a href="#!" data-type="announcement" data-id='{{$announcement->id}}' class="set-favorite secondary-content right"><i class="material-icons {{($star)?'orange-text':''}}">star</i></a>
            @else
                <a href="#modal-please-login" class="modal-trigger secondary-content right"><i class="material-icons">star</i></a>
            @endauth
        @endif

        <p class="flow-text center truncate"><a href="{{route('announcements.show', $announcement->id)}}">{{$announcement->title}}</a></p>
        <p class="truncate">{{str_limit($announcement->text, 50)}}</p>
        <p class="truncate">Author: <a href="{{route('profiles.show', $announcement->user->id )}}" class="black-text" >{{$announcement->user->first_name}} {{$announcement->user->last_name}} <i class="material-icons tiny">open_in_new</i></a></p>
        <p class="truncate">Date: {{$announcement->created_at}}</p>
        <p class="truncate">Code: {{$announcement->id}}</p>
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
            <a href="{{route('announcements.edit', $announcement->id)}}" ><i class="material-icons tiny">edit</i> Edit</a>
            <a href="{{route('announcements.show', $announcement->id)}}" >show</a>
            @include('inc.share-button', ['type'=>'link', 'link'=>'#'])
            <a data-actionroute='{{route('announcements.destroy', $announcement->id)}}'  class="modal-open-delete btn-floating halfway-fab waves-effect waves-light red"  ><i class="material-icons">delete_forever</i></a>
        @else
            <a href="{{route('announcements.show', $announcement->id)}}">show more</a>
            @include('inc.share-button', ['type'=>'floating', 'link'=>'#'])
            @auth
                @if($user->id == $announcement->user->id)
                    <a href="{{route('announcements.edit', $announcement->id)}}"><i class="material-icons tiny">edit</i> edit</a>
                @else
                    <a href="{{route('announcements.show', $announcement->id)}}#modal-reply">reply</a>
                @endif
            @else
                <a href="#modal-please-login" class="modal-trigger">reply</a>
            @endauth
        @endif

    </div>
</div>




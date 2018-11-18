<div class="card ">
    <div class="card-image waves-effect waves-block waves-light">
        <a href="{{$photo->image}}" class="big">
            <img src="{{$photo->thumb}}" alt="" title="{{$photo->title}}">
        </a>
    </div>

    <div class="card-content">
        @if(!empty($editable) and $editable == true)
            <span><a href="{{route('photos.edit', $photo->id)}}"><i class="material-icons">edit</i></a></span>
        @endif
            <i class="material-icons right card-title activator chip">expand_less</i>
            <p class="truncate"> <a class="black-text" >{{$photo->title}}</a></p>
            <p class="truncate">Author: <a href="{{route('profiles.show', $photo->user->id )}}" class="black-text" >{{$photo->user->first_name}} {{$photo->user->last_name}} <i class="material-icons tiny">open_in_new</i></a></p>
            <p class="truncate">Date: {{$photo->created_at}}</p>
            <a href="#" class="btn-floating halfway-fab waves-effect waves-light " ><i class="material-icons ">share</i></a>


    </div>
    <div class="card-reveal">
        <span class="card-title grey-text text-darken-4">{{$photo->title}}<i class="material-icons right">close</i></span>
        @if($photo->tags->first())
            <div class="divider"></div>
            <p>
                @foreach($photo->tags as $tag)
                    <a class="chip" href="{{route('photos.index', ['tag'=>$tag->name])}}">{{$tag->name}}</a>
                @endforeach
            </p>
        @endif

    </div>
</div>

<div class="card medium">
    <div class="card-image waves-effect waves-block waves-light">
        <a href="{{route('posts.show', $post->id)}}"><img  src="{{$post->thumb}}"></a>
    </div>
    <div class="card-content">

        <a href='#' class="btn-floating halfway-fab waves-effect waves-light red" ><i class="material-icons">share</i></a>
        {{--//TODO share link--}}

        <span class="card-title  grey-text text-darken-4 truncate">{{$post->title}}</span>
        <i class="material-icons right card-title activator">more_vert</i>
        @if(!empty($post->tags))
            @foreach($post->tags as $tag)
                <a class="chip" href="{{route('posts.index', ['tag'=>$tag->name])}}">{{$tag->name}}</a>
            @endforeach
        @endif

    </div>

    <div class="card-reveal">
        <i class="material-icons right card-title">close</i>
        <span class="card-title grey-text text-darken-4">{{$post->title}}</span>
        <div class="divider"></div>
        <p>{{$post->text}}</p>
    </div>
</div>
<div class="card">
    <div class="card-image waves-effect waves-block waves-light">
        <a href="{{route('posts.show', $post->id)}}"><img  src="{{$post->thumb}}"></a>
    </div>
    <div class="card-content">
        @if(!empty($editable) and $editable == true)
            <span><a href="{{route('posts.edit', $post->id)}}"><i class="material-icons">edit</i></a></span>
            <a data-postaction='{{route('posts.destroy', $post->id)}}' class="modal-open-delete btn-floating halfway-fab waves-effect waves-light red" ><i class="material-icons">delete_forever</i></a>
        @else
            <a href='#' class="btn-floating halfway-fab waves-effect waves-light red" ><i class="material-icons">share</i></a>
        @endif
        {{--//TODO share link--}}

        <span class="card-title  grey-text text-darken-4 truncate">{{$post->title}}</span>
        <i class="material-icons right card-title activator chip">expand_less</i>
            @if(empty($blog_name))
                <p class="truncate">Blog: <a href="{{route('blogs.show', $post->blogger->id )}}" class="black-text" >{{$post->blogger->name}}</a></p>
            @else
                <p class="truncate">PostID: {{$post->id }}</p>
            @endif
        <p class="truncate">Date: {{$post->created_at}}</p>

    </div>

    <div class="card-reveal">
        <i class="material-icons right card-title">close</i>

        <span class="card-title grey-text text-darken-4">{{$post->title}}</span>

        @if($post->tags->first())
            <div class="divider"></div>
            <p>
                @foreach($post->tags as $tag)
                    <a class="chip" href="{{route('posts.index', ['tag'=>$tag->name])}}">{{$tag->name}}</a>
                @endforeach
            </p>
        @endif

        <div class="divider"></div>

        <p>{{$post->text}}</p>
    </div>
</div>
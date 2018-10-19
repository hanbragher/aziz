<div class="card medium">
    <div class="card-image waves-effect waves-block waves-light">
        {{--<a href="#"><img class="activator" src="/images/card.jpg"></a>--}}
        <a href="{{$route}}"><img  src="{{$mainImage}}"></a>
    </div>
    <div class="card-content">
        @if(!empty($editable) and $editable == true)
        <span><a href="{{route('posts.edit', $id)}}"><i class="material-icons">edit</i></a></span>
        @endif
        <span class="card-title  grey-text text-darken-4 truncate">{{$title}}</span>
            <i class="material-icons right card-title activator">more_vert</i>
        @if(!empty($tags))
            @foreach($tags as $tag)
                <a class="chip" href="#">{{$tag->name}}</a>
            @endforeach
        @endif

    </div>
    <div class="card-reveal">
        <i class="material-icons right card-title">close</i>
        <span class="card-title grey-text text-darken-4">{{$title}}</span>
        <div class="divider"></div>
        <p>{{$text}}</p>
    </div>
</div>
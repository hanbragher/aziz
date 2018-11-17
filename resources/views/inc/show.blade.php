<div class="row">
    <h5 class="flow text center">{{$data->title}}</h5>

    <i class="tiny material-icons">label_outline</i> {{$data->id}}
    <span class="right">{{$data->created_at}} <i class="tiny material-icons">access_time</i></span>

    <p><img class="materialboxed" src="{{$data->image}}" height="150"
            align="left"
            vspace="5" hspace="5">
        {!!$data->text!!}
    </p>
</div>

<div class="row">
    @foreach($data->tags as $tag)
        <div class="chip">
            <a href="{{route('posts.index', ['tag'=>$tag->name])}}">{{$tag->name}}</a>
        </div>
    @endforeach
</div>



<div class="row">
    @if(!empty($type) and $type == "blog")
        Author: <a href="{{route('profiles.show', $data->blogger->id )}}" target="_blank" class="black-text" >{{$data->blogger->name}} <i class="material-icons tiny">open_in_new</i></a>
    @else
        Author: <a href="{{route('profiles.show', $data->user->id )}}" target="_blank" class="black-text" >{{$data->user->first_name}} {{$data->user->last_name}} <i class="material-icons tiny">open_in_new</i></a>
    @endif

    <div class="divider"></div>
    @foreach($data->images as $image)
        <div class="gallery col s4 m3 l2">
            @include('inc.gallery', ['image'=>$image])
        </div>
    @endforeach
</div>

<div class="row">
    <a class='btn' href="{{URL::previous()}}"><i class="material-icons left">arrow_back</i>Back</a>
    @auth
    <a class='modal-trigger btn right' href="#modal-reply">Reply<i class="material-icons right">rotate_right</i></a>
    @else
        <a class='modal-trigger btn right' href="#modal-please-login">Reply<i class="material-icons right">rotate_right</i></a>
    @endauth
</div>

<script>
    $('.gallery a ').simpleLightbox();

</script>
<div class="row">
    <h5 class="flow text center">{{$data->title}}</h5>

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
    <div class="divider"></div>
    @foreach($data->images as $image)
        <div class="gallery col s4 m3 l2">
            @include('inc.gallery', ['image'=>$image])
        </div>
    @endforeach
</div>

<div class="row">
    <a class='btn' href="{{URL::previous()}}"><i class="material-icons left">arrow_back</i>Back</a>
    <a class='modal-trigger btn right' href="#modal-reply">Reply<i class="material-icons right">rotate_right</i></a>
</div>

<script>
    $('.gallery a ').simpleLightbox();

</script>
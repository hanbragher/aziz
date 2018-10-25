@extends('layouts.layout')

@section('links')
    <link href="/css/simplelightbox.min.css" rel="stylesheet">
@endsection
@section('links_after')
    <script src="/js/simple-lightbox.min.js"></script>
@endsection

@section('content')

    <div class="row">
        <div class="col s12">
            @include('widgets.home_slider')
        </div>
    </div>

    <div class="row">
        <div class="col s12 m4 l1 hide-on-med-and-down"></div>

        <div class="col s12 m12 l10">
            <h5 class="flow text center">{{$post->title}}</h5>

            <p><img class="materialboxed" src="{{$post->image}}" height="150"
                    align="left"
                    vspace="5" hspace="5">{{$post->text}}</p>


            <div class="divider"></div>

            @foreach($post->images as $image)
                <div class="gallery col s4 m3 l2">
                    @include('widgets.test_gallery', ['image'=>$image])
                </div>
            @endforeach

        </div>

        <div class="col s12 m4 l1 hide-on-med-and-down"></div>
    </div>

    <div class="row">
        <a href="{{URL::previous()}}">Back</a>
        {{--{{$post->links()}}--}}
    </div>

    <script src="/js/slider_mini_script.js"></script>

    <script>
        $('.gallery a ').simpleLightbox();

    </script>

@endsection
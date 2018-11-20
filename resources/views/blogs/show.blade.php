@extends('layouts.layout')

@section('content')

    <div class="row">
        <div class="col s12">
            @include('widgets.home_slider')
            @include('inc.tag-search-bar', ['route'=>route('posts.index')])
        </div>
    </div>

    @include('inc.notifications')

    <div class="row">
        <div class="col s12 m4 l1 hide-on-med-and-down"></div>

        <div class="col s12 m12 l10">

            @foreach($posts as $post)
                    @include('inc.post', ['post'=>$post])
            @endforeach

        </div>

        <div class="col s12 m4 l1 hide-on-med-and-down"></div>
    </div>

    <div class="row center">
        {{$posts->appends($_GET)->links()}}
    </div>

    <script src="/js/slider_mini_script.js"></script>

@endsection
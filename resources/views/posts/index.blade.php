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
            @if($posts->first())
                @foreach($posts as $post)
                    <div class="col s6 m4 l3">
                        @include('inc.post', [
                        'post'=> $post])
                    </div>
                @endforeach
            @else
                <p class="flow-text center">No posts</p>
            @endif


        </div>

        <div class="col s12 m4 l1 hide-on-med-and-down"></div>
    </div>

    <div class="row center">
        {{$posts->appends($_GET)->links()}}
    </div>

    <script src="/js/slider_mini_script.js"></script>

@endsection
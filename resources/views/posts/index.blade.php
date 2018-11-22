@extends('layouts.layout')

@section('content')

    <div class="row">
        <div class="col s12">
            @include('widgets.home_slider')
            @include('inc.tag-search-bar', ['route'=>route('posts.index')])
        </div>
    </div>

    @include('inc.toast-notifications')

    <div class="row">
        <div class="col s12 m4 l1 hide-on-med-and-down"></div>

        <div class="col s12 m12 l10">
            @if($posts->first())
                @foreach($posts as $post)
                        @include('inc.post', [
                        'post'=> $post])
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
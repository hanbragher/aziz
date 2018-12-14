@extends('layouts.layout')

@section('content')
    <div class="row">
        <div class="col s12">
            @include('widgets.parallax', ['cover'=>$show_user->blog->cover])
            @include('inc.middlemenu', ['avatar'=>$show_user->avatar, 'header'=>$show_user->blog->name])
        </div>
    </div>

    @include('inc.toast-notifications')

    <div class="col s12 m4 l1 hide-on-med-and-down"></div>
    </div>

    <div class="row">
        <div class="col s12 m12 l1 hide-on-med-and-down"></div>

        <div class="col s12 m12 l2">
            @include('inc.usersidenav', ['active'=>'user_posts'])
        </div>

        <div class="col s12 m12 l8">
            <div class="row">
                @if($show_user->blog->posts->first())
                    @foreach($show_user->blog->posts as $post)
                        @include('inc.post', [
                            'post'=> $post])
                    @endforeach
                @else
                    <p class="flow-text center">Do not have posts</p>
                @endif



            </div>
        </div>

        <div class="col s12 m6 l1">

        </div>
    </div>
    <script src="/js/slider_mini_script.js"></script>

@endsection





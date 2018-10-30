@extends('layouts.layout')

@section('content')
    <div class="row">
        <div class="col s12">
            @include('widgets.parallax', ['cover'=>$show_user->cover])
            @include('inc.middlemenu', ['avatar'=>$show_user->avatar?$show_user->avatar:'none', 'header'=>'Posts'])
        </div>
    </div>

    @include('inc.notifications')

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
                        <div class="col s6 m4 l3">
                            @include('widgets.card', [
                             'editable' => false,
                             'route'=> route('posts.show', $post->id),
                             'mainImage'=> $post->thumb,
                             'id' => $post->id,
                             'title' => $post->title,
                             'tags' => $post->tags,
                             'text' => $post->text
                             ])
                        </div>
                    @endforeach
                @else
                    <p class="flow-text center">Do not have posts</p>
                @endif

            </div>
        </div>

        <div class="col s12 m6 l1">

        </div>
    </div>

@endsection





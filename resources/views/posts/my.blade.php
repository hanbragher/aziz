@extends('layouts.layout')

@section('links')

@endsection

@section('content')
    <div class="fixed-action-btn ">
        <a class="btn-floating btn-large red" href="{{route('posts.create')}}">
            <i class="large material-icons">mode_edit</i>
        </a>
    </div>


    <div class="row">
        <div class="col s12">
            @include('widgets.parallax', ['cover'=>$user->cover])
            @include('inc.middlemenu', ['avatar'=>$user->avatar, 'header'=>'My posts'])
        </div>
    </div>

    @include('inc.notifications')

    <div class="col s12 m4 l1 hide-on-med-and-down"></div>
    </div>

    <div class="row">
        <div class="col s12 m12 l1 hide-on-med-and-down"></div>

        <div class="col s12 m12 l2 hide-on-med-and-down">
            @include('inc.mysidenav', ['active'=>'myposts'])
        </div>

        <div class="col s12 m12 l8">
            <div class="row">
                @foreach($posts as $post)
                    <div class="col s6 m4 l3">
                        @include('widgets.card', [
                         'editable' => true,
                         'route'=> route('posts.show', $post->id),
                         'mainImage'=> $post->thumb,
                         'id' => $post->id,
                         'title' => $post->title,
                         'tags' => $post->tags,
                         'text' => $post->text
                         ])
                    </div>

                @endforeach

            </div>

            <div class="row center">

                {{$posts->appends($_GET)->links()}}
            </div>
        </div>

        <div class="col s12 m6 l1">

        </div>
    </div>



@endsection





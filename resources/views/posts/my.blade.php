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
            @include('widgets.parallax', ['cover'=>$user->blog->cover])
            @include('inc.middlemenu', ['avatar'=>$user->avatar, 'header'=>$user->blog->name])
        </div>
    </div>

    @include('inc.toast-notifications')

    @include('inc.modal-destroy-form')

    <div class="col s12 m4 l1 hide-on-med-and-down"></div>
    </div>

    <div class="row">
        <div class="col s12 m12 l1 hide-on-med-and-down"></div>

        <div class="col s12 m12 l2 hide-on-med-and-down">
            @include('inc.mysidenav', ['active'=>$active_menu])
        </div>

        <div class="col s12 m12 l8">
            <div class="row">
                @foreach($posts as $post)
                        @include('inc.post', [
                         'editable' => true,
                         'blog_name'=> 'hide',
                         'post'=> $post
                         ])
                @endforeach

            </div>

            <div class="row center">

                {{$posts->appends($_GET)->links()}}
            </div>
        </div>

        <div class="col s12 m6 l1">

        </div>
    </div>

    <script src="/js/modal-destroy-form.js"></script>



@endsection





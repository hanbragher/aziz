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
            @include('widgets.parallax', ['cover'=>'/images/parallax1690x300.jpg'])
            @include('inc.middlemenu', ['avatar'=>'/images/parallax1.jpg', 'header'=>'My posts'])
        </div>
    </div>
    <div class="col s12 m4 l1 hide-on-med-and-down"></div>
    </div>

    <div class="row">
        <div class="col s12 m12 l1 hide-on-med-and-down"></div>

        <div class="col s12 m12 l2 hide-on-med-and-down">
            @include('inc.mysidenav', ['active'=>'myposts'])
        </div>

        <div class="col s12 m12 l8">
            <div class="row">
                @for ($i=1; $i<=10; $i++)
                    <div class="col s6 m4 l3">
                        @include('widgets.card', ['editable' => true, 'route'=> route('posts.show', 1), 'title'=> 'mypost'.$i])
                    </div>
                @endfor
            </div>
        </div>

        <div class="col s12 m6 l1">

        </div>
    </div>


@endsection





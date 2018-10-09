@extends('layouts.layout')

@section('links')

@endsection

@section('content')
    <div class="fixed-action-btn ">
        <a class="btn-floating btn-large red" href="/newpost">
            <i class="large material-icons">mode_edit</i>
        </a>
    </div>


    <div class="row">
        <div class="col s12">
            <div class="parallax-container" style="height:300px;">
                <div class="parallax"><img src="images/parallax2.jpg"></div>
            </div>
            @include('inc.middlemenu')
        </div>
    </div>
    <div class="col s12 m4 l1 hide-on-med-and-down"></div>
    </div>

    <div class="row">
        <div class="col s12 m12 l1 hide-on-med-and-down"></div>

        <div class="col s12 m12 l2 ">
            @include('widgets.mysidenav')
        </div>

        <div class="col s12 m12 l8">
            <div class="row">
                @for ($i=1; $i<=10; $i++)
                    <div class="col s6 m4 l3">
                        @include('widgets.card')
                    </div>

                @endfor
            </div>
        </div>

        <div class="col s12 m6 l1">

        </div>
    </div>


@endsection





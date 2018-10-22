@extends('layouts.layout')

@section('links')

@endsection

@section('content')
    <div class="row">
        <div class="col s12">
            @include('widgets.parallax', ['cover'=>'/images/parallax1690x300.jpg'])
            @include('inc.middlemenu', ['avatar'=>$user->avatar?$user->avatar:'none', 'header'=>'My Messeges'])
        </div>
    </div>
    <div class="col s12 m4 l1 hide-on-med-and-down"></div>
    </div>

    <div class="row">
        <div class="col s12 m12 l1 hide-on-med-and-down"></div>

        <div class="col s12 m12 l2 hide-on-med-and-down">
            @include('inc.mysidenav', ['active'=>'messeges'])
        </div>

        <div class="col s12 m12 l8">
            <div class="row">
                <div class="col s12">
                    <ul class="tabs">
                        <li class="tab col s6"><a class="active" href="#inbox">inbox</a></li>
                        <li class="tab col s6"><a href="#outbox">outbox</a></li>
                    </ul>
                </div>

                <div id="inbox" class="col s12">
                    <ul class="collection">
                        @for($i=1; $i<5; $i++)
                            @include('inc.chat')
                        @endfor
                    </ul>
                </div>
                <div id="outbox" class="col s12">
                    <ul class="collection">
                        @for($i=1; $i<3; $i++)
                            @include('inc.chat')
                        @endfor
                    </ul>
                </div>

            </div>


        </div>

        <div class="col s12 m6 l1">

        </div>
    </div>

@endsection





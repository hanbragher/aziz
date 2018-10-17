@extends('layouts.layout')

@section('content')
    <div class="row">
        <div class="col s12">
            @include('widgets.parallax', ['cover'=>'/images/parallax1690x300.jpg'])
            @include('inc.middlemenu', ['avatar'=>$user->avatar->file, 'header'=>'My Page'])
        </div>
    </div>
    <div class="col s12 m4 l1 hide-on-med-and-down">

    </div>

    <div class="row">
        <div class="col s12 m12 l1 hide-on-med-and-down"></div>

        <div class="col s12 m12 l2 hide-on-med-and-down">
            @include('inc.mysidenav', ['active'=>'mypage'])
        </div>

        <div class="col s12 m12 l8">

            <div class="col s12 m6 l6">
                <div class="card horizontal">
                    <div class="card-image">
                        <img src="/images/card.jpg">
                    </div>
                    <div class="card-stacked">
                        <div class="card-content">
                            <p>I am a very simple card. I am good at containing small bits of information.</p>
                        </div>
                        <div class="card-action">
                            <a href="#">This is a link</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col s12 m6 l6">
                <div class="card horizontal">
                    <div class="card-image">
                        <img src="/images/card.jpg">
                    </div>
                    <div class="card-stacked">
                        <div class="card-content">
                            <p>I am a very simple card. I am good at containing small bits of information.</p>
                        </div>
                        <div class="card-action">
                            <a href="#">This is a link</a>
                        </div>
                    </div>
                </div>
            </div>


        </div>

        <div class="col s12 m6 l1">

        </div>
    </div>

@endsection





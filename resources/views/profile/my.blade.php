@extends('layouts.layout')

@section('links')

@endsection

@section('content')
    <div class="row">
        <div class="col s12">
            @include('widgets.parallax')
            @include('inc.middlemenu')
        </div>
    </div>
    <div class="col s12 m4 l1 hide-on-med-and-down">

    </div>

    <div class="row">
        <div class="col s12 m12 l1 hide-on-med-and-down"></div>

        <div class="col s12 m12 l2">
            @include('widgets.mysidenav', ['active'=>'mypage'])
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





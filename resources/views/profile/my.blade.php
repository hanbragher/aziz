@extends('layouts.layout')

@section('content')
    <div class="row">
        <div class="col s12">
            @include('widgets.parallax', ['cover'=>$user->cover])
            @include('inc.middlemenu', ['avatar'=>$user->avatar, 'header'=>'My Page'])
        </div>
    </div>

    @include('inc.toast-notifications')


    <div class="col s12 m4 l1 hide-on-med-and-down">
    </div>

    <div class="row">
        <div class="col s12 m12 l1 hide-on-med-and-down"></div>

        <div class="col s12 m12 l2 hide-on-med-and-down">
            @include('inc.mysidenav', ['active'=>'mypage'])
        </div>

        <div class="col s12 m12 l8">

            @include('inc.overview-selector-bar', ['active'=>$active])

            <div class="col s12">
                <div class="card horizontal">
                    <div class="card-image">
                        {{--<img src="/images/card.jpg">--}}
                    </div>
                    <div class="card-stacked">
                        <div class="card-content">
                            <p>Total favorites count: {{$user->totalfavorites()}}</p>
                        </div>
                        <div class="card-action">
                            <a href="{{route('favorites.index')}}">Jump to favorites</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col s12">
                <div class="card horizontal">
                    <div class="card-image">
                        <i class="material-icons">add</i>
                    </div>
                    <div class="card-stacked">
                        <div class="card-content">
                            <p>Total favorites count: {{$user->totalfavorites()}}</p>
                        </div>
                        <div class="card-action">
                            <a href="{{route('favorites.index')}}">Jump to favorites</a>
                        </div>
                    </div>
                </div>
            </div>

            {{--<div class="col s12 m6 l6">
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
            </div>--}}


        </div>

        <div class="col s12 m6 l1">

        </div>
    </div>

@endsection





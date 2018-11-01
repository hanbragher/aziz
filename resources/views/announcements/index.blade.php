@extends('layouts.layout')



@section('content')

    <div class="row">
        <div class="col s12">
            @include('widgets.home_slider')
        </div>
    </div>

    <div class="row">
        <div class="col s12 m4 l1 hide-on-med-and-down"></div>

        <div class="col s12 m12 l10">

            @foreach($announcements as $announcement)
                <div class="col s12 m12 l6 ">
                    @include('inc.announcement', ['star'=>true])
                </div>
            @endforeach

        </div>

        <div class="col s12 m4 l1 hide-on-med-and-down"></div>
    </div>

    <div class="row center">
        {{$announcements->appends($_GET)->links()}}
    </div>

    <script src="/js/slider_mini_script.js"></script>

@endsection
@extends('layouts.layout')

@section('content')

    <div class="row">
        <div class="col s12">
            @include('widgets.home_slider')
            @include('inc.middlemenu')
        </div>
    </div>

<div class="row center">
    <div class="col s12 m4 l1 hide-on-med-and-down"></div>

    <div class="col s12 m12 l10">

        <div class="row">
            @for ($i=1; $i<=10; $i++)
                <div class="col s6 m4 l3">
                    @include('widgets.card', ['route' => route('posts.show', 1), 'title'=>'index'])
                </div>
            @endfor
        </div>

    </div>

    <div class="col s12 m4 l1 hide-on-med-and-down"></div>
</div>

    <script src="/js/slider_script.js"></script>

@endsection
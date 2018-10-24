@extends('layouts.layout')

@section('links')
    <link href="/css/simplelightbox.min.css" rel="stylesheet">
@endsection
@section('links_after')
    <script src="/js/simple-lightbox.min.js"></script>
@endsection

@section('content')

    <div class="row">
        <div class="col s12">
            @include('widgets.parallax', ['cover'=>'/images/places_cover.jpg'])

            @include('inc.middlemenu', ['avatar' => 'hide', 'header'=>!empty($place) ? $place : 'all'])
        </div>
    </div>
    <div class="col s12 m4 l1 hide-on-med-and-down"></div>
    </div>

    <div class="row">
        <div class="col s12 m12 l1 hide-on-med-and-down"></div>

        <div class="col s12 m12 l2 hide-on-med-and-down">
            @include('inc.places_sidenav', ['active'=> !empty($place) ? $place : 'all'])
        </div>

        <div class="col s12 m12 l8">


                    @for ($i=1; $i<=9; $i++)
                        <div class="col s6 m4 l3">
                            @include('widgets.test_card', ['i'=>$i, 'route'=>route('places.show', 1), 'title'=>$place.$i])
                        </div>
                    @endfor

        </div>

        <div class="col s12 m6 l1">

        </div>
    </div>

    <script>
        $('.gallery a ').simpleLightbox();
    </script>

@endsection





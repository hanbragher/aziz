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

            @include('inc.middlemenu', ['avatar'=> 'hide', 'header'=>!empty($place) ? $place : 'all'])
        </div>
    </div>
    <div class="col s12 m4 l1 hide-on-med-and-down"></div>
    </div>

    <div class="row">
        <div class="col s12 m12 l1 hide-on-med-and-down"></div>

        <div class="col s12 m12 l2 hide-on-med-and-down">
            @include('inc.places_sidenav', ['active'=> !empty($_GET['places']) ? $_GET['places'] : 'all'])
        </div>

        <div class="col s12 m12 l8">

            <div class="row">
                <div class="col s12">
                    <ul class="tabs">
                        <li class="tab col s3"><a href="#tab1">Inf</a></li>
                        <li class="tab col s3"><a class="active" href="#tab2">Pictures</a></li>
                        <li class="tab col s3"><a href="#tab3">Map</a></li>
                        <li class="tab col s3"><a href="#tab4">Notes</a></li>
                    </ul>
                </div>
                <div id="tab1" class="col s12">Test 1</div>
                <div id="tab2" class="col s12">
                    @for ($i=1; $i<=9; $i++)
                        <div class="gallery col s6 m4 l3">
                            @include('widgets.test_gallery', ['i'=>$i])
                        </div>
                    @endfor
                </div>
                <div id="tab3" class="col s12">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d11464.644258196766!2d44.88619372202204!3d40.79609652152879!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4041aba4d266d437%3A0x293121c72328670b!2z0JzQvtC90LDRgdGC0YvRgNGMINCQ0LPQsNGA0YbQuNC9!5e1!3m2!1sru!2s!4v1539005943475" width="100%" height="500" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>
                <div id="tab4" class="col s12">
                    comments
                </div>
            </div>
        </div>

        <div class="col s12 m6 l1">

        </div>
    </div>

    <script src="/js/simple-lightbox-activator.js"></script>


@endsection





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
            @include('widgets.home_slider')
        </div>
    </div>

    <div class="row">
        <div class="col s12 m4 l1 hide-on-med-and-down"></div>

        <div class="col s12 m12 l10">
            @include('inc.show', [
                        'type' => 'blog',
                        'data'=> $post])
        </div>

        <div class="col s12 m4 l1 hide-on-med-and-down"></div>

    </div>

    <script src="/js/slider_mini_script.js"></script>

@endsection
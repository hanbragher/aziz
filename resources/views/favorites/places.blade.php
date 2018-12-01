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
            @include('widgets.parallax', ['cover'=>$user->cover])
            @include('inc.middlemenu', ['avatar'=>$user->avatar, 'header'=>'Favorite Photos'])
        </div>
    </div>

    @include('inc.toast-notifications')

    <div class="col s12 m4 l1 hide-on-med-and-down"></div>
    </div>

    <div class="row">
        <div class="col s12 m12 l1 hide-on-med-and-down"></div>

        <div class="col s12 m12 l2 hide-on-med-and-down">
            @include('inc.mysidenav', ['active'=>'favorite'])
        </div>

        <div class="col s12 m12 l8">

            @include('inc.favorite-selector-bar', ['active'=>$active])

            @include('inc.modal-add-comment')

            <div class="row">
                @if($places->first())
                    @foreach($places as $place)
                        @include('inc.place_card', [
                        'star'=> $user->favoritePlaces->contains($place->id),
                        'place'=>$place
                        ])
                    @endforeach
                @else
                    <p class="flow-text center">No places</p>
                @endif
            </div>

            <div class="row center">
                {{$places->appends($_GET)->links()}}
            </div>

        </div>
        <div class="col s12 m6 l1">

        </div>

    </div>

    <script src="/js/simple-lightbox-activator.js"></script>
    <script src="/js/set-favorite.js"></script>
    <script src="/js/modal-add-comment.js"></script>

@endsection

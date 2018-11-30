@extends('layouts.layout')


@section('content')

    <div class="row">
        <div class="col s12">
            @include('widgets.parallax', ['cover'=>'/images/places_cover.jpg'])

            @include('inc.middlemenu', ['avatar' => 'hide', 'header'=>!empty($place_menu) ? $place_menu : 'all'])
        </div>
    </div>
    <div class="col s12 m4 l1 hide-on-med-and-down"></div>
    </div>

    <div class="row">
        <div class="col s12 m12 l1 hide-on-med-and-down"></div>

        <div class="col s12 m12 l2 hide-on-med-and-down">
            @include('inc.places_sidenav', ['active'=> !empty($place_menu) ? $place_menu : 'all'])
        </div>

        <div class="col s12 m12 l8">

            <div class="row">
                @if($places->first())

                    @guest
                    @php $star =  false;  @endphp
                    @include('inc.modal-please-login')
                    @endguest

                    @foreach($places as $place)
                        @auth
                        @php $star =  $user->favoritePhotos->contains($place->id) @endphp
                        @endauth
                        @include('inc.place_card', [
                        'star'=> $star,
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

    <script src="/js/set-favorite.js"></script>
    <script>
        $(document).ready(function(){
            $('.modal').modal();
        });
    </script>


@endsection





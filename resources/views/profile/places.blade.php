@extends('layouts.layout')

@section('content')
    <div class="row">
        <div class="col s12">
            @include('widgets.parallax', ['cover'=>$show_user->cover])
            @include('inc.middlemenu', ['avatar'=>$show_user->avatar, 'header'=>'Posts'])
        </div>
    </div>

    @include('inc.toast-notifications')

    <div class="col s12 m4 l1 hide-on-med-and-down"></div>
    </div>

    <div class="row">
        <div class="col s12 m12 l1 hide-on-med-and-down"></div>

        <div class="col s12 m12 l2">
            @include('inc.usersidenav', ['active'=>'user_places'])
        </div>

        <div class="col s12 m12 l8">
            <div class="row">
                @if($show_user->places->first())
                    @guest
                    @php $star =  false;  @endphp
                    @include('inc.modal-please-login')
                    @endguest

                    @foreach($show_user->places as $place)
                        @auth
                        @php $star =  $user->favoritePlaces->contains($place->id) @endphp
                        @endauth
                        @include('inc.place_card', [
                        'star'=> $star,
                        'place'=>$place
                        ])
                    @endforeach
                @else
                    <p class="flow-text center">Do not have places</p>
                @endif



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





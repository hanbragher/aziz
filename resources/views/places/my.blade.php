@extends('layouts.layout')

@section('content')
    <div class="fixed-action-btn ">
        <a class="btn-floating btn-large red" href="{{route('posts.create')}}">
            <i class="large material-icons">mode_edit</i>
        </a>
    </div>


    <div class="row">
        <div class="col s12">
            @include('widgets.parallax', ['cover'=>$user->cover])
            @include('inc.middlemenu', ['avatar'=>$user->avatar, 'header'=>'My posts'])
        </div>
    </div>

    @include('inc.toast-notifications')

    @include('inc.modal-destroy-form')

    <div class="col s12 m4 l1 hide-on-med-and-down"></div>
    </div>

    <div class="row">
        <div class="col s12 m12 l1 hide-on-med-and-down"></div>

        <div class="col s12 m12 l2 hide-on-med-and-down">
            @include('inc.mysidenav', ['active'=>'myplaces'])
        </div>

        <div class="col s12 m12 l8">
            <div class="row">
                @if($places->first())
                    @foreach($places as $place)
                        @include('inc.place_card', [
                        'star'=> $user->favoritePlaces->contains($place->id),
                        'place'=>$place,
                        'editable'=>true,
                        ])
                    @endforeach
                @else
                    <p class="flow-text center">No places</p>
                    <p class="center"><a href="{{route('places.create')}}" class="btn-flat">create a new</a></p>

                @endif

            </div>

            <div class="row center">

                {{$places->appends($_GET)->links()}}
            </div>
        </div>

        <div class="col s12 m6 l1">

        </div>
    </div>

    <script src="/js/modal-destroy-form.js"></script>
    <script src="/js/set-favorite.js"></script>






@endsection





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
            @include('widgets.parallax', ['cover'=>$show_user->cover])
            @include('inc.middlemenu', ['avatar'=>$show_user->avatar, 'header'=>'Photos'])
        </div>
    </div>

    @include('inc.toast-notifications')

    @include('inc.modal-add-comment')


    <div class="col s12 m4 l1 hide-on-med-and-down"></div>
    </div>

    <div class="row">
        <div class="col s12 m12 l1 hide-on-med-and-down"></div>

        <div class="col s12 m12 l2">
            @include('inc.usersidenav', ['active'=>'user_photos'])
        </div>

        <div class="col s12 m12 l8">
            <div class="row gallery">
                @if($show_user->photos->first())
                    @guest
                    @php $star =  false;  @endphp
                    @include('inc.modal-please-login')
                    @endguest

                    @foreach($show_user->photos as $photo)
                        @auth
                        @php $star =  $user->favoritePhotos->contains($photo->id) @endphp
                        @endauth
                        @include('inc.photo_card', [
                               'photo'=>$photo])
                    @endforeach
                @else
                    <p class="flow-text center">Do not have photos</p>
                @endif

            </div>
        </div>

        <div class="col s12 m6 l1">

        </div>
    </div>

    <script src="/js/slider_mini_script.js"></script>
    <script src="/js/set-favorite.js"></script>
    <script src="/js/simple-lightbox-activator.js"></script>

    <script>
        $(document).ready(function(){
            $('.modal').modal();
        });
    </script>

    @auth
    <script src="/js/modal-add-comment.js"></script>
    @endauth

@endsection





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
            @include('inc.tag-search-bar', ['route'=>route('photos.index')])
        </div>

    </div>

    @include('inc.notifications')

    @include('inc.modal-add-comment')

    <div class="row">
        <div class="col s12 m4 l1 hide-on-med-and-down"></div>

        <div class="gallery col s12 m12 l10">

            @if($photos->first())
                @guest
                @php $star =  false;  @endphp
                @include('inc.modal-please-login')
                @endguest

                @foreach($photos as $photo)
                        @auth
                        @php $star =  $user->favoritePhotos->contains($photo->id) @endphp
                        @endauth
                        @include('inc.photo_card', [
                               'photo'=>$photo])
                @endforeach

            @else
                <p class="flow-text center">No announcements</p>
            @endif


        </div>

        <div class="col s12 m4 l1 hide-on-med-and-down"></div>
    </div>

    <div class="row center">
        {{$photos->appends($_GET)->links()}}
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
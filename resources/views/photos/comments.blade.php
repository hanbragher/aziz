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
            @include('inc.middlemenu', ['avatar'=>$user->avatar, 'header'=>'My notes'])
        </div>
    </div>

    @include('inc.toast-notifications')

    @include('inc.modal-destroy-form')

    <div class="col s12 m4 l1 hide-on-med-and-down"></div>
    </div>

    <div class="row">
        <div class="col s12 m12 l1 hide-on-med-and-down"></div>

        <div class="col s12 m12 l2 hide-on-med-and-down">
            @include('inc.mysidenav', ['active'=>'myphotos'])
        </div>

        <div class="col s12 m12 l8">



                <div class="row">
                    <div class="gallery">
                        @include('inc.photo_card', [
                        'star'=> $user->favoritePhotos->contains($photo->id),
                        'photo'=>$photo,
                        'read_comments'=>'inactive',
                        ])
                    </div>

                    @if($comments->first())

                    <div class="col s12 m8 l8 ">
                        @foreach($comments as $comment)
                            @include('inc.photo-comment', ['comment'=>$comment])
                        @endforeach
                    </div>
                    @else
                        <p class="flow-text center">No comments</p>
                    @endif

                </div>
                <div class="row">
                    <a class='btn' href="{{route('photos.my')}}"><i class="material-icons left">arrow_back</i>My photos</a>
                </div>





        </div>

        <div class="col s12 m6 l1">

        </div>
    </div>
    <script src="/js/simple-lightbox-activator.js"></script>

    <script src="/js/set-favorite.js"></script>
    <script src="/js/modal-destroy-form.js"></script>

@endsection





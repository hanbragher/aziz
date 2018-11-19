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

    @include('inc.notifications')

    @include('inc.modal-destroy-form')

    <div class="modal delete">
        <form action="/" method="post" id="delete_post_form" enctype="multipart/form-data">
            @method('DELETE')
            @csrf
            <div class="modal-content">
                <h4>Delete confirmation</h4>
                <p>Do you want to delete this photo?</p>
            </div>
            <div class="modal-footer">
                <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancel</a>
                <button class="btn red">Delete</button>
            </div>
        </form>
    </div>

    <div class="col s12 m4 l1 hide-on-med-and-down"></div>
    </div>

    <div class="row">
        <div class="col s12 m12 l1 hide-on-med-and-down"></div>

        <div class="col s12 m12 l2 hide-on-med-and-down">
            @include('inc.mysidenav', ['active'=>'favoritesphotos'])
        </div>

        <div class="col s12 m12 l8">
            <div class="gallery row">
                @if($photos->first())
                    @foreach($photos as $photo)
                        <div class="col col s6 m4 l3">
                            @include('inc.photo_card', [
                            'star'=> $user->favoritePhotos->contains($photo->id),
                            'photo'=>$photo,
                            'editable'=>false])
                        </div>
                    @endforeach
                @else
                    <p class="flow-text center">No photos</p>
                    <p class="center"><a href="{{route('photos.create')}}" class="btn-flat">create a new</a></p>
                @endif
            </div>

            <div class="row center">
                {{$photos->appends($_GET)->links()}}
            </div>

        </div>
        <div class="col s12 m6 l1">

        </div>

    </div>
    <script>
        $('.gallery a.big ').simpleLightbox();
    </script>
    <script src="/js/modal-destroy-form.js"></script>
    <script src="/js/set-favorite.js"></script>



@endsection

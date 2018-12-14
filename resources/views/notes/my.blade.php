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
            @include('inc.mysidenav', ['active'=>$active_menu])
        </div>

        <div class="gallery col s12 m12 l8">
            @foreach($notes as $note)
                    @include('inc.note', [
                    'note'=>$note,
                    'editable'=>true])
            @endforeach

            <div class="row center">
                {{$notes->appends($_GET)->links()}}
            </div>
        </div>

        <div class="col s12 m6 l1">

        </div>
    </div>


    <script>
        $('.gallery a.notes-big ').simpleLightbox({
            captionDelay: 1000,
        });
    </script>
    <script src="/js/modal-destroy-form.js"></script>





@endsection





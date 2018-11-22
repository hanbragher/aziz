@extends('layouts.layout')

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
            @if($comments->first())
                @foreach($comments as $comment)
                    @include('inc.photo-comment', ['comment'=>$comment])
                @endforeach
            @else
                <p class="flow-text center">No comments</p>
            @endif
        </div>

        <div class="col s12 m6 l1">

        </div>
    </div>

    <script src="/js/modal-destroy-form.js"></script>

@endsection





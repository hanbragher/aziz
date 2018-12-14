@extends('layouts.layout')

@section('content')
    <div class="row">
        <div class="col s12">
            @include('widgets.parallax', ['cover'=>$user->cover])
            @include('inc.middlemenu', ['avatar'=>$user->avatar, 'header'=>'Notifications'])
        </div>
    </div>

    @include('inc.toast-notifications')

    @include('inc.modal-clear-list-form')

    <div class="col s12 m4 l1 hide-on-med-and-down">

    </div>

    <div class="row">
        <div class="col s12 m12 l1 hide-on-med-and-down"></div>

        <div class="col s12 m12 l2 hide-on-med-and-down">
            @include('inc.mysidenav', ['active'=>$active_menu])
        </div>

        <div class="col s12 m12 l8">
            <div class="row">
                @include('inc.overview-selector-bar', ['active'=>$active])
            </div>

            @if($notifications->first())
                <div class="row">
                    <div class="col s12">
                        <button data-actionroute='{{route('notifications.destroy', $user->id)}}' class="modal-clear-list btn-small right" >Clear list<i class="material-icons right">speaker_notes_off</i></button>
                    </div>
                </div>

                @foreach($notifications as $notification)
                    @include('inc.notification', ['notification'=>$notification])
                @endforeach
            @else
                <p class="flow-text center">No notifications</p>
            @endif

        </div>

        <div class="col s12 m6 l1">

        </div>
    </div>
    <script src="/js/modal-clear-list.js"></script>


@endsection





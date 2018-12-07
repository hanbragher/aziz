@extends('layouts.layout')

@section('content')

    <div class="row">
        <div class="col s12">
            @auth
                @include('inc.middlemenu', ['avatar'=>$user->avatar, 'header'=>'Admin'])
            @endauth
        </div>
    </div>

    @include('inc.toast-notifications')

    <div class="col s12 m4 l1 hide-on-med-and-down">

    </div>

    <div class="row">
        <div class="col s12 m12 l1 hide-on-med-and-down"></div>

        <div class="col s12 m12 l2 hide-on-med-and-down">
            @include('admin.inc.adminsidenav', ['active'=>'home'])
        </div>

        <div class="col s12 m12 l8">


        </div>

        <div class="col s12 m6 l1">
        </div>
    </div>


@endsection
@extends('layouts.layout')

@section('content')
    <div class="row">
        <div class="col s12">
            @include('widgets.parallax', ['cover'=>$show_user->cover])
            @include('inc.middlemenu', ['avatar'=>$show_user->avatar, 'header'=>$show_user->first_name.' '.$show_user->last_name])

        </div>
    </div>
    <div class="col s12 m4 l1 hide-on-med-and-down">

    </div>

    <div class="row">
        <div class="col s12 m12 l1 hide-on-med-and-down"></div>

        <div class="col s12 m12 l2">
            @include('inc.usersidenav', ['active'=>'user_page'])
        </div>

        <div class="col s12 m12 l8">

            <h4>
                This is an example quotation that uses the blockquote tag.
            </h4>


        </div>

        <div class="col s12 m6 l1">

        </div>
    </div>

@endsection





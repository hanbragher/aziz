@extends('layouts.layout')

@section('content')
    <div class="row">
        <div class="col s12">
            @include('widgets.parallax', ['cover'=>$user->cover])
            @include('inc.middlemenu', ['avatar'=>$user->avatar?$user->avatar:'none', 'header'=>'My Messeges'])
        </div>
    </div>
    <div class="col s12 m4 l1 hide-on-med-and-down"></div>
    </div>

    <div class="row">
        <div class="col s12 m12 l1 hide-on-med-and-down"></div>

        <div class="col s12 m12 l2 hide-on-med-and-down">
            @include('inc.mysidenav', ['active'=>'myadverts'])
        </div>

        <div class="col s12 m12 l8">
            <div class="row">
                @for($i=1; $i<10; $i++)
                    @include('inc.advert', ['editable'=>true])
                @endfor

            </div>


        </div>

        <div class="col s12 m6 l1">

        </div>
    </div>

@endsection





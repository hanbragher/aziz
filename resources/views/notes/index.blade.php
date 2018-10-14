@extends('layouts.layout')

@section('links')

@endsection

@section('content')
    <div class="row">
        <div class="col s12">
            @include('widgets.parallax')
            @include('inc.middlemenu')
        </div>
    </div>
    <div class="col s12 m4 l1 hide-on-med-and-down"></div>
    </div>

    <div class="row">
        <div class="col s12 m12 l1 hide-on-med-and-down"></div>

        <div class="col s12 m12 l2 ">
            @include('inc.mysidenav', ['active'=>'mynotes'])
        </div>

        <div class="col s12 m12 l8">
                @for($i=1; $i<10; $i++)
                    @include('inc.note', ['editable'=>true])
                @endfor
        </div>

        <div class="col s12 m6 l1">

        </div>
    </div>


@endsection





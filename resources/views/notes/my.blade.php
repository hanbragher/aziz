@extends('layouts.layout')

@section('content')
    <div class="row">
        <div class="col s12">
            @include('widgets.parallax', ['cover'=>$user->cover])
            @include('inc.middlemenu', ['avatar'=>$user->avatar, 'header'=>'My notes'])
        </div>
    </div>
    <div class="col s12 m4 l1 hide-on-med-and-down"></div>
    </div>

    <div class="row">
        <div class="col s12 m12 l1 hide-on-med-and-down"></div>

        <div class="col s12 m12 l2 hide-on-med-and-down">
            @include('inc.mysidenav', ['active'=>'mynotes'])
        </div>

        <div class="col s12 m12 l8">
            @foreach($user->notes as $note)
                    @include('inc.note', [
                    'note'=>$note,
                    'editable'=>true])
            @endforeach
        </div>

        <div class="col s12 m6 l1">

        </div>
    </div>


@endsection





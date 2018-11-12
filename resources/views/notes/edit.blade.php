@extends('layouts.layout')

@section('content')
    <div class="row">
        <div class="col s12">
            @include('widgets.parallax')
            @include('inc.middlemenu', ['avatar'=>$user->avatar,])
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
            <form action="#">
                <div class="input-field">
                    <input value="Alvin" id="first_name2" type="text" class="validate">
                    <label class="active" for="first_name2">Note</label>
                </div>
                <a class='btn' href="{{route('notes.index')}}" > <i class="material-icons left">chevron_left</i> Back</a>
                <button class="btn">Update<i class="material-icons right">send</i></button>
            </form>
        </div>

        <div class="col s12 m6 l1">

        </div>
    </div>


@endsection





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
    <div class="col s12 m4 l1 hide-on-med-and-down">

    </div>

    <div class="row">
        <div class="col s12 m12 l1 hide-on-med-and-down"></div>

        <div class="col s12 m12 l2">

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





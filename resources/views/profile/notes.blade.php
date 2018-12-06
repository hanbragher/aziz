@extends('layouts.layout')

@section('content')
    <div class="row">
        <div class="col s12">
            @include('widgets.parallax', ['cover'=>$show_user->cover])
            @include('inc.middlemenu', ['avatar'=>$show_user->avatar, 'header'=>'Posts'])
        </div>
    </div>

    @include('inc.toast-notifications')

    <div class="col s12 m4 l1 hide-on-med-and-down"></div>
    </div>

    <div class="row">
        <div class="col s12 m12 l1 hide-on-med-and-down"></div>

        <div class="col s12 m12 l2">
            @include('inc.usersidenav', ['active'=>'user_notes'])
        </div>

        <div class="col s12 m12 l8">
            <div class="row">
                @if($show_user->notes->first())
                    @foreach($show_user->notes as $note)
                            @include('inc.note', [
                            'note'=>$note,
                            'editable'=>false])
                    @endforeach
                @else
                    <p class="flow-text center">Do not have posts</p>
                @endif

            </div>
        </div>

        <div class="col s12 m6 l1">

        </div>
    </div>

@endsection





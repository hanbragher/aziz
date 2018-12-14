@extends('layouts.layout')

@section('content')
    <div class="row">
        <div class="col s12">
            @include('widgets.parallax', ['cover'=>$pick_user->cover])
            @include('inc.middlemenu', ['avatar'=>$pick_user->avatar, 'header'=>'Change Password'])
        </div>
    </div>

    @include('inc.toast-notifications')

    <div class="col s12 m4 l1 hide-on-med-and-down">

    </div>

    <div class="row">
        <div class="col s12 m12 l1 hide-on-med-and-down"></div>

        <div class="col s12 m12 l2 hide-on-med-and-down">
            @include('inc.mysidenav', ['active'=>$active_menu])
        </div>

        <div class="col s12 m12 l8">

            <form action="{{route('profiles.update', $pick_user->id)}}"  method="post" enctype="multipart/form-data">
                @method('PUT')
                @csrf

                <div class="input-field">
                    <i class="material-icons prefix">dialpad</i>
                    <input id="old_password" type="password" class="validate" name="old_password" required>
                    <label for="old_password">Old password</label>
                </div>

                <div class="input-field">
                    <i class="material-icons prefix">dialpad</i>
                    <input id="password" type="password" class="validate" name="password" required>
                    <label for="password">New password</label>
                </div>

                <div class="input-field">
                    <i class="material-icons prefix">dialpad</i>
                    <input id="password" type="password" class="validate" name="password_confirmation" required>
                    <label for="password">Password confirmation</label>
                </div>

                <button class="btn">Save password<i class="material-icons right">save</i></button>
            </form>


        </div>
        <div class="col s12 m6 l1">
        </div>
    </div>


@endsection





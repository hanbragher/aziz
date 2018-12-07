@extends('layouts.layout')

@section('content')

    <div class="row" xmlns="http://www.w3.org/1999/html">
        <div class="col s12">
            @auth
            @include('inc.middlemenu', ['avatar'=>$user->avatar, 'header'=>'Users'])
            @endauth
        </div>
    </div>

    @include('inc.toast-notifications')

    @include('inc.modal-destroy-form')

    <div class="modal moderate">
        <form action="/" method="post" id="moderate_post_form">
            @csrf
            <div class="modal-content">
                <h4>Moderate</h4>
                <p>Do you want to change "moderate" status?</p>
            </div>
            <div class="modal-footer">
                <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancel</a>
                <button  class="btn blue">Change</button>
            </div>
        </form>
    </div>


    <div class="col s12 m4 l1 hide-on-med-and-down">

    </div>

    <div class="row">
        <div class="col s12 m12 l1 hide-on-med-and-down"></div>

        <div class="col s12 m12 l2 hide-on-med-and-down">
            @include('admin.inc.adminsidenav', ['active'=>'users'])
        </div>

        <div class="col s12 m12 l8">
            <div class="row">
                {{--<div class="input-field col s6">
                    <form action="{{route('adminplaces.index')}}">
                        <select name="place">
                            <option value="all" {{($active == 'all')?'selected':''}}>all</option>
                            <option value="not_moderated" {{($active == 'not_moderated')?'selected':''}}>Not moderated</option>
                            @foreach($categories as $category)
                                <option value="{{$category}}" {{($active == $category)?'selected':''}}>{{$category}}</option>
                            @endforeach
                        </select>
                        <label>Select category</label>
                        <button class='btn ' type="submit">Show</button>
                    </form>--}}
                </div>
            </div>


            <div class="row">
                {{--@if($places->first())
                    @foreach($places as $place)
                        @include('admin.inc.place_card', [
                        'star'=> $user->favoritePlaces->contains($place->id),
                        'place'=>$place,
                        ])
                    @endforeach
                @else
                    <p class="flow-text center">No places</p>
                    <p class="center"><a href="{{route('places.create')}}" class="btn-flat" target="_blank">create a new</a></p>

                @endif--}}
            </div>

            <div class="row">


            </div>
        </div>

        <div class="col s12 m6 l1">
        </div>
    </div>

    <script src="/js/modal-destroy-form.js"></script>
    <script src="/js/set-favorite.js"></script>

    <script>
        $(document).ready(function(){
            var elems = document.getElementsByClassName('modal moderate');
            var instance = M.Modal.init(elems[0]);
            $("a.modal-open-moderate").click(function () {
                document.getElementById('moderate_post_form').action = $(this).data("actionroute");
                instance.open()
            });


            $('select').formSelect();
        });
    </script>

@endsection
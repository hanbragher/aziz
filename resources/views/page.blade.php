@extends('layouts.layout')

@section('content')

    <div class="row">
        <div class="col s12">
            <div class="parallax-container" style="height:300px;">
                <div class="parallax"><img src="images/parallax2.jpg"></div>
            </div>
            @include('inc.middlemenu')
        </div>
    </div>
        <div class="col s12 m4 l1 hide-on-med-and-down"></div>
    </div>




    <div class="row center">
        <div class="col s12 m12 l1 hide-on-med-and-down"></div>

        <div class="col s12 m12 l2">
            <div class="collection">
                <a href="#!" class="collection-item">Shirak</a>
                <a href="#!" class="collection-item active">Lori</a>
                <a href="#!" class="collection-item">Tavush</a>
                <a href="#!" class="collection-item">Aragatsotn</a>
                <a href="#!" class="collection-item">Kotayk</a>
            </div>
        </div>

        <div class="col s12 m12 l8">
            <div class="row">
                @for ($i=1; $i<=10; $i++)
                    <div class="col s6 m4 l3">
                        @include('widgets.card')
                    </div>
                @endfor
            </div>
        </div>

        <div class="col s12 m6 l1">
            side
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $('.collapsible').collapsible();
        });

        $(document).ready(function(){
            $('.sidenav.right').sidenav({edge:'right'});
        });

        $(document).ready(function(){
            $('.sidenav.left').sidenav();
        });

        $('.dropdown-trigger').dropdown();

        $(document).ready(function(){
            $('.parallax').parallax();
        });
    </script>
@endsection





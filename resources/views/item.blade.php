@extends('layouts.layout')

@section('links')

    @endsection

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
                <a href="#!" class="collection-item">Agartcin</a>
                <a href="#!" class="collection-item active">Gosh</a>
                <a href="#!" class="collection-item">Saint Sargis Chapel</a>
                <a href="#!" class="collection-item">Aragatsotn</a>
                <a href="#!" class="collection-item">Kotayk</a>
            </div>
        </div>

        <div class="col s12 m12 l8">
            <div class="row">


                <div class="row">
                    <div class="col s12">
                        <ul class="tabs">
                            <li class="tab col s3"><a href="#test1">inform</a></li>
                            <li class="tab col s3"><a class="active" href="#test2">nkerner</a></li>
                            <li class="tab col s3"><a href="#test3">qartez</a></li>
                            <li class="tab col s3"><a href="#test4">Test 4</a></li>
                        </ul>
                    </div>
                    <div id="test1" class="col s12">Test 1</div>
                    <div id="test2" class="col s12">
                        @for ($i=1; $i<=10; $i++)
                            <div class="col s6 m4 l3">
                                @include('widgets.card')
                            </div>
                        @endfor
                    </div>
                    <div id="test3" class="col s12">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d11464.644258196766!2d44.88619372202204!3d40.79609652152879!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4041aba4d266d437%3A0x293121c72328670b!2z0JzQvtC90LDRgdGC0YvRgNGMINCQ0LPQsNGA0YbQuNC9!5e1!3m2!1sru!2s!4v1539005943475" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                    </div>
                    <div id="test4" class="col s12">Test 4</div>
                </div>



            </div>
        </div>

        <div class="col s12 m6 l1">
            side
        </div>
    </div>




    <script>

        $(document).ready(function(){
            $('.tabs').tabs();
        });

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





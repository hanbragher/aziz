@extends('layouts.layout')

@section('content')

    <div class="row">
        <div class="col s12">
            <div class="parallax-container">
                <div class="parallax"><img src="images/parallax1.jpg"></div>
            </div>
            @include('inc.middlemenu')
        </div>
    </div>

<div class="row center">
    <div class="col s12 m4 l1 hide-on-med-and-down"></div>

    <div class="col s12 m12 l10">

        <div class="row">
            @for ($i=1; $i<=10; $i++)
                <div class="col s6 m4 l3">
                    @include('widgets.card')
                </div>
            @endfor
        </div>

    </div>


    <div class="col s12 m4 l1 hide-on-med-and-down"></div>
</div>

<div class="row center">
    <div class="col s12 m4 l2"><p>s12 m4 l2</p></div>
    <div class="col s12 m4 l8"><p>s12 m4 l8</p></div>
    <div class="col s12 m4 l2"><p>s12 m4 l8</p></div>
</div>


<div class="row center">
    <div class="col s12 m12 l1"></div>
    <div class="col s12 m6 l2 hide-on-med-and-down"><p>s12 m6 l3 fgjdfgjdfg jdfjfg jfghjdyj ghkjdghkj fghk</p></div>
    <div class="col s12 m6 l6"><p>s12 m6 l6</p></div>
    <div class="col s12 m6 l2"><p>s12 m6 l3</p></div>
    <div class="col s12 m6 l3"><p>s12 m6 l3</p></div>
</div>


<script>
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





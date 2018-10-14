@extends('layouts.layout')

@section('content')

    <div class="row">
        <div class="col s12">

                <div class="slider">
                    <ul class="slides">
                        <li>
                            <img src="/images/parallax1.jpg"> <!-- random image -->
                            <div class="caption center-align">
                                <h3>This is our big Tagline!</h3>
                                <h5 class="light grey-text text-lighten-3">Here's our small slogan.</h5>
                            </div>
                        </li>
                        <li>
                            <img src="https://images.pexels.com/photos/220444/pexels-photo-220444.jpeg?cs=srgb&dl=city-man-person-220444.jpg&fm=jpg"> <!-- random image -->
                            <div class="caption left-align">
                                <h3>Left Aligned Caption</h3>
                                <h5 class="light grey-text text-lighten-3">Here's our small slogan.</h5>
                            </div>
                        </li>
                        <li>
                            <img src="https://images.pexels.com/photos/9816/pexels-photo-9816.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"> <!-- random image -->
                            <div class="caption right-align">
                                <h3>Right Aligned Caption</h3>
                                <h5 class="light grey-text text-lighten-3">Here's our small slogan.</h5>
                            </div>
                        </li>
                        <li>
                            <img src="https://images.pexels.com/photos/40066/railway-40066.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"> <!-- random image -->
                            <div class="caption center-align">
                                <h3>This is our big Tagline!</h3>
                                <h5 class="light grey-text text-lighten-3">Here's our small slogan.</h5>
                            </div>
                        </li>
                    </ul>
                </div>
            {{--<div class="parallax-container">
                <div class="parallax"><img src="images/parallax1.jpg"></div>
            </div>--}}
            @include('inc.middlemenu')
        </div>
    </div>

<div class="row center">
    <div class="col s12 m4 l1 hide-on-med-and-down"></div>

    <div class="col s12 m12 l10">

        <div class="row">
            @for ($i=1; $i<=10; $i++)
                <div class="col s6 m4 l3">
                    @include('widgets.card', ['route' => route('posts.show', 1), 'title'=>'index'])
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
            $('.slider').slider({
                indicators:false,
                height:500,
                duration:600,
                interval:3000,

            });
        });
    </script>

@endsection





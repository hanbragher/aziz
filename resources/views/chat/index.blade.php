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

    <div class="row">
        <div class="col s12 m12 l1 hide-on-med-and-down"></div>

        <div class="col s12 m12 l2 ">
            @include('widgets.mysidenav')
        </div>

        <div class="col s12 m12 l8">
            <ul class="collection">
                <li class="collection-item avatar">
                    <img src="images/card.jpg" alt="" class="circle">
                    <span class="title">Title</span>
                    <p>First Line <br>
                        Second Line
                    </p>
                    <a href="#!" class="secondary-content"><i class="material-icons">grade</i></a>
                </li>
                <li class="collection-item avatar">
                    <img src="images/card.jpg" alt="" class="circle">
                    <span class="title">Title</span>
                    <p>First Line <br>
                        Second Line
                    </p>
                    <a href="#!" class="secondary-content"><i class="material-icons">grade</i></a>
                </li>
                <li class="collection-item avatar">
                    <img src="images/card.jpg" alt="" class="circle">
                    <span class="title">Title</span>
                    <p>First Line <br>
                        Second Line
                    </p>
                    <a href="#!" class="secondary-content"><i class="material-icons">grade</i></a>
                </li>
            </ul>
        </div>

        <div class="col s12 m6 l1">

        </div>
    </div>

@endsection





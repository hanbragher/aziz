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
            <form action="/test">

                <div class="row">
                    <div class="input-field col s6">
                        <input id="input_text" type="text" data-length="100" name="title">
                        <label for="input_text">Title</label>
                    </div>
                    <div class="file-field input-field col s6">
                        <div class="btn">
                            <span>File</span>
                            <input type="file">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate"  name="mmm">
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="input-field col s12">
                        <textarea id="textarea1" class="materialize-textarea" name="text"></textarea>
                        <label for="textarea1">Textarea</label>
                    </div>
                </div>


                <div class="chips chips-autocomplete" type="text"></div>

                <button class="btn">send</button>
            </form>



        </div>

        <div class="col s12 m6 l1">

        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('input#input_text, textarea#textarea2').characterCounter();
        });

        $('.chips-autocomplete').chips({
            autocompleteOptions: {
                data: {
                    @for($i=1; $i<=15; $i++)
                    'Apple{{$i}}': null,
                    @endfor
                    'Apple': null,
                    'Microsoft': null,
                    'Google': null
                },
                limit: Infinity,
                minLength: 1
            }
        });



    </script>

@endsection





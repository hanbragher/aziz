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
    <div class="col s12 m4 l1 hide-on-med-and-down"></div>
    </div>

    <div class="row">
        <div class="col s12 m12 l1 hide-on-med-and-down"></div>

        <div class="col s12 m12 l2 ">
            @include('inc.mysidenav', ['active'=>'newpost'])
        </div>

        <div class="col s12 m12 l8">
            <form action="/test" method="post">
                @csrf
                <div class="row">
                    <div class="input-field col s4">
                        <input id="input_text" type="text" data-length="100" name="title">
                        <label for="input_text">Title</label>
                    </div>
                </div>

                <div class="row">
                    <div class="file-field input-field col s5">
                        <div class="btn">
                            <span>Cover image</span>
                            <input type="file">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate"  name="cover" placeholder="choose cover image" >
                        </div>
                    </div>
                    <div class="file-field input-field col s7">
                        <div class="btn">
                            <span>Gallery photos</span>
                            <input type="file" multiple>
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate"  name="gallery" placeholder="upload max 10 images into post gallery">
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="input-field col s12">
                        <textarea id="textarea1" class="materialize-textarea" name="text"></textarea>
                        <label for="textarea1">Textarea</label>
                    </div>
                </div>


                <div class="chips chips-autocomplete"></div>

                <button class="btn" id="button" >Publish<i class="material-icons right">send</i></button>

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
            placeholder: 'Enter a tag',
            secondaryPlaceholder: '+Tag',
            data: [{
                tag: 'Apple',
            }, {
                tag: 'Microsoft',
            }, {
                tag: 'Google',
            }],
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

        $('#button').click(function(){
            var dataString = JSON.stringify(M.Chips.getInstance($('.chips')).chipsData);

        });





    </script>

@endsection





@extends('layouts.layout')

@section('links')

@endsection

@section('content')

    <div class="row">
        <div class="col s12">
            @include('widgets.parallax', ['cover'=>'/images/parallax1690x300.jpg'])
            @include('inc.middlemenu', ['avatar'=>'/images/parallax1.jpg', 'header'=>'New post'])
        </div>
    </div>
    <div class="col s12 m4 l1 hide-on-med-and-down"></div>
    </div>

    <div class="row">
        <div class="col s12 m12 l1 hide-on-med-and-down"></div>

        <div class="col s12 m12 l2 hide-on-med-and-down">
            @include('inc.mysidenav', ['active'=>'newpost'])
        </div>

        <div class="col s12 m12 l8">
            <form action="{{route('posts.store')}}" method="post" id="form" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="input-field col s4">
                        <input id="input_text" type="text" data-length="100" name="title" required>
                        <label for="input_text">Title</label>
                    </div>
                </div>

                <div class="row">
                    <div class="file-field input-field col s5">
                        <div class="btn">
                            <span>Main image</span>
                            <input type="file" name="main_image">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" placeholder="choose main image" >
                        </div>
                    </div>
                    <div class="file-field input-field col s7">
                        <div class="btn">
                            <span>Gallery photos</span>
                            <input type="file" name="gallery[]" multiple>
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate"  name="gallery" placeholder="upload max 10 images into post gallery">
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="input-field col s12">
                        <textarea id="textarea1" class="materialize-textarea" name="text" required></textarea>
                        <label for="textarea1">Textarea</label>
                    </div>
                </div>

                <div class="chips chips-autocomplete">
                </div>

                <button class="btn" >Publish<i class="material-icons right">send</i></button>

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
                    @foreach($tags as $tag)
                    '{{$tag}}': null,
                    @endforeach
                },
                limit: Infinity,
                minLength: 1
            }
        });

        $('#form').submit(function(e){
            var data = JSON.stringify(M.Chips.getInstance($('.chips')).chipsData);
            $(this).append('<input type="hidden" name="tags" value='+data+'>');
            return true;
        });





    </script>

@endsection





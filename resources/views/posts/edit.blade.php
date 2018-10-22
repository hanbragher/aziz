@extends('layouts.layout')

@section('links')

@endsection

@section('content')
    <div class="fixed-action-btn ">
        <a class="btn-floating btn-large red" href="{{route('posts.create')}}">
            <i class="large material-icons">mode_edit</i>
        </a>
    </div>


    <div class="row">
        <div class="col s12">
            @include('widgets.parallax', ['cover'=>'/images/parallax1690x300.jpg'])
            @include('inc.middlemenu', ['avatar'=>'/images/parallax1.jpg', 'header'=>'My posts'])
        </div>
    </div>

    @include('inc.notifications')

    <div class="col s12 m4 l1 hide-on-med-and-down"></div>
    </div>

    <div class="row">
        <div class="col s12 m12 l1 hide-on-med-and-down"></div>

        <div class="col s12 m12 l2 hide-on-med-and-down">
            @include('inc.mysidenav', ['active'=>'myposts'])
        </div>

        <div class="col s12 m12 l8">
            <div class="row">



                <!-- Modal Structure -->
                <div id="image_delete" class="modal">
                    <form action="{{route('posts.update', $post->id)}}" method="post" id="form1" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="modal-content">
                            <h4>Delete confirmation</h4>
                            <p>Do you want to remove image from post?</p>
                            <input id="image_id" name="image_id" value="" type="hidden">
                            <input id="post_id" name="post_id" value="" type="hidden">
                        </div>
                        <div class="modal-footer">
                            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancel</a>
                            <button class="btn red">Delete</button>
                        </div>
                    </form>
                </div>



                <form action="{{route('posts.update', $post->id)}}" method="post" id="form" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="input-field col s4">
                            <input value='{{$post->title}}' id="input_text" type="text" data-length="100" name="title" required>
                            <label for="input_text">Title</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="file-field input-field col s5">
                            <div class="btn">
                                <span>Change image</span>
                                <input type="file" name="main_image">
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate" placeholder="Change main image" >
                            </div>
                        </div>
                        <div class="file-field input-field col s7">
                            <div class="btn">
                                <span>Gallery photos</span>
                                <input type="file" name="gallery[]" multiple>
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate"  name="gallery" placeholder="can upload max 10 images into post gallery">
                            </div>
                        </div>
                    </div>

                    @if($post->images->first())
                        <div class="row">
                            @foreach($post->images as $image)
                                <div class="col col s6 m3 l2">
                                    <div class="card small">
                                        <div class="card-image">
                                            <img class="materialboxed"  src="{{$image->file}}">
                                        </div>
                                        <div class="card-action">
                                            <p><a class="teal-text" href="{{$image->file}}" download><i class="material-icons">file_download</i></a></p>
                                            <a data-imageid='{{$image->id}}' data-postid='{{$post->id}}' href="#delete_image" class="modal-open btn-floating halfway-fab waves-effect waves-light red" ><i class="material-icons">delete_forever</i></a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    @endif



                    <div class="row">
                        <div class="input-field col s12">
                            <textarea  id="textarea1" class="materialize-textarea" name="text" required>{{$post->text}}</textarea>
                            <label for="textarea1">Textarea</label>
                        </div>
                    </div>

                    <div class="chips chips-autocomplete">
                    </div>

                    <button class="btn" >Update<i class="material-icons right">send</i></button>

                </form>


            </div>
        </div>

        <div class="col s12 m6 l1">

        </div>
    </div>
    <script>

        $(document).ready(function(){
            var elems = document.getElementsByClassName('modal');;
            var instance = M.Modal.init(elems[0]);
            $("a.modal-open").click(function () {

                $("input#image_id").val($(this).data("imageid"));
                $("input#post_id").val($(this).data("postid"));
                instance.open()
            })
        });



        $(document).ready(function() {
            $('input#input_text, textarea#textarea2').characterCounter();
        });



        $('.chips-autocomplete').chips({
            placeholder: 'Enter a tag',
            secondaryPlaceholder: '+Tag',
            data: [
                @foreach($post->tags as $tag)
                {tag: '{{$tag->name}}',},
                @endforeach
            ],
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





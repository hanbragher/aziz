@extends('layouts.layout')

@section('links')
    <link href="/css/simplelightbox.min.css" rel="stylesheet">
@endsection

@section('links_after')
    <script src="/js/simple-lightbox.min.js"></script>
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
            @include('inc.middlemenu', ['avatar'=>$post->image, 'header'=> '<a href="'.route('posts.show', $post->id).'" target="blank"><i class="material-icons">open_in_new</i></a>' ])
        </div>
    </div>

    @include('inc.toast-notifications')

    <div class="col s12 m4 l1 hide-on-med-and-down"></div>
    </div>

    <div class="row">
        <div class="col s12 m12 l1 hide-on-med-and-down"></div>

        <div class="col s12 m12 l2 hide-on-med-and-down">
            @include('inc.mysidenav', ['active'=>$active_menu])
        </div>

        <div class="col s12 m12 l8">
            <div class="row">

                <!-- Modal Structure -->
                <div class="modal delete">
                    <form action="{{route('posts.update', $post->id)}}" method="post" id="form1" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="modal-content">
                            <h4>Delete confirmation</h4>
                            <p>Do you want to remove image from post?</p>
                            <input id="image_id" name="image_id" value="" type="hidden">
                            <input id="post_id" name="post_id" value="" type="hidden">
                            <input name="destroy" value='destroy' type="hidden">
                        </div>
                        <div class="modal-footer">
                            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancel</a>
                            <button class="btn red">Delete</button>
                        </div>
                    </form>
                </div>

                <div class="modal title">
                    <form action="{{route('posts.update', $post->id)}}" method="post" id="form1" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="modal-content input-field">
                            <h4>Image title</h4>
                            <input id="image_id" name="image_id" value="" type="hidden">
                            <input id="post_id" name="post_id" value="" type="hidden">
                            <input name="set_title" value="set_title" type="hidden">
                            <input id="image_title" name="image_title" value="" placeholder="max 100 character" data-length="100">
                        </div>
                        <div class="modal-footer">
                            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancel</a>
                            <button class="btn">Save</button>
                        </div>
                    </form>
                </div>



                <form action="{{route('posts.update', $post->id)}}" method="post" id="form" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="input-field col s4">
                            <input value='{{$post->title}}' id="title" type="text" data-length="100" name="title" required>
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
                                <label>max 2MB</label>
                            </div>
                        </div>

                        <div class="file-field input-field col s7">
                            @if(12-($images_count = $post->images->count()) > 0)

                            <div class="btn">
                                <span>Gallery photos</span>
                                <input type="file" name="gallery[]" multiple>
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate"  name="gallery" placeholder="can upload max {{12-$images_count}} images into gallery">

                            </div>
                            @else
                                <label>You have uploaded the maximum number of images for the gallery.</label>
                            @endif

                        </div>

                    </div>


                    @if($post->images->first())
                        <div class="row ">
                            @foreach($post->images as $image)
                                <div class="col col s6 m3 l2">
                                    <div class="card">
                                        <div class="card-image waves-effect waves-block waves-light gallery">
                                            <a href="{{$image->file}}" class="big" >
                                                <img class="" src="{{$image->thumb}}" title="{{$image->title}}">
                                            </a>
                                        </div>
                                        <a data-imageid='{{$image->id}}' data-postid='{{$post->id}}' data-imagetitle='{{$image->title}}' href="#delete_image" class="modal-open-title truncate grey-text center" ><i class="material-icons tiny">create</i>{{!empty($image->title)?$image->title:'Add title'}}</a>

                                        <p><a class="teal-text" href="{{$image->file}}" download><i class="material-icons">file_download</i></a></p>
                                        <a data-imageid='{{$image->id}}' data-postid='{{$post->id}}' href="#delete_image" class="modal-open-delete btn-floating halfway-fab waves-effect waves-light red" ><i class="material-icons">delete_forever</i></a>
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

    <script src="/js/simple-lightbox-activator.js"></script>

    <script>

        $(document).ready(function(){
            var elems = document.getElementsByClassName('modal delete');;
            var instance = M.Modal.init(elems[0]);
            $("a.modal-open-delete").click(function () {

                $("input#image_id").val($(this).data("imageid"));
                $("input#post_id").val($(this).data("postid"));
                instance.open()
            })
        });

        $(document).ready(function(){
            var elems = document.getElementsByClassName('modal title');;
            var instance = M.Modal.init(elems[0]);
            $("a.modal-open-title").click(function () {

                $("input#image_id").val($(this).data("imageid"));
                $("input#post_id").val($(this).data("postid"));
                $("input#image_title").val($(this).data("imagetitle"));
                instance.open()
            })
        });



        $(document).ready(function() {
            $('input#title, input#image_title').characterCounter();
        });



        $('.chips-autocomplete').chips({
            placeholder: 'Enter a tag',
            secondaryPlaceholder: '+Tag',
            data: [
                @if(!empty(old('tags')))
                    @foreach(json_decode(old('tags')) as $tag)
                        {tag: '{{$tag->tag}}',},
                    @endforeach
                @else
                    @foreach($post->tags as $tag)
                        {tag: '{{$tag->name}}',},
                    @endforeach
                @endif
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

    </script>
    <script src="/js/add-tags-on-submit-form.js"></script>



@endsection





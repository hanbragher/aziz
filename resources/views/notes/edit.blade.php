@extends('layouts.layout')

@section('links')
    <link href="/css/simplelightbox.min.css" rel="stylesheet">
@endsection

@section('links_after')
    <script src="/js/simple-lightbox.min.js"></script>
@endsection


@section('content')
    <div class="row">
        <div class="col s12">
            @include('widgets.parallax')
            @include('inc.middlemenu', ['avatar'=>$user->avatar,])
        </div>
    </div>

    @include('inc.toast-notifications')

    <div class="col s12 m4 l1 hide-on-med-and-down"></div>
    </div>

    <div class="row">
        <div class="col s12 m12 l1 hide-on-med-and-down"></div>

        <div class="col s12 m12 l2 ">
            @include('inc.mysidenav', ['active'=>'mynotes'])
        </div>

        <div class="col s12 m12 l8">

            <div id="image_delete" class="modal delete">
                <form action="{{route('notes.update', $note->id)}}" method="post" id="form1">
                    @method('PUT')
                    @csrf
                    <div class="modal-content">
                        <h4>Delete confirmation</h4>
                        <p>Do you want to remove image from note?</p>
                        <input id="image_id" name="image_id" value="" type="hidden">
                        <input name="destroy" value='destroy' type="hidden">
                    </div>
                    <div class="modal-footer">
                        <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancel</a>
                        <button class="btn red">Delete</button>
                    </div>
                </form>
            </div>

            <form action="{{route('notes.update', $note->id)}}" method="post" id="form" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="input-field">
                    <input value="{{$note->text}}" id="text" type="text" name="text" class="validate">
                    <label class="active" for="text">Note</label>
                </div>

                <div class="file-field input-field col s12">
                    @if(12-($images_count = $note->images->count()) > 0)

                        <div class="btn">
                            <span>Additional photos</span>
                            <input type="file" name="images[]" multiple>
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" placeholder="can upload max {{12-$images_count}} images into gallery">

                        </div>
                    @else
                        <p>
                            <span>You have uploaded the maximum number of images for the gallery.</span>
                        </p>
                    @endif
                </div>

                @if($note->images->first())
                    <div class="row gallery">
                        <table>
                            <tbody>
                                @foreach($note->images as $image)
                                    <tr>
                                        <td class="left">
                                            <a href="{{$image->file}}" class="big" >
                                                <img class="" src="{{$image->thumb}}" title="">
                                            </a>
                                        </td>
                                        <td class="right">
                                            <a data-imageid='{{$image->id}}' href="#delete_image" class="modal-open-delete btn halfway-fab waves-effect waves-light red" ><i class="material-icons">delete_forever</i></a>
                                        </td>
                                        <td class="left">
                                            <a class="teal-text" href="{{$image->file}}" download><i class="material-icons">file_download</i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif





                <a class='btn' href="{{route('notes.index')}}" > <i class="material-icons left">chevron_left</i> Back</a>
                <button class="btn">Update<i class="material-icons right">send</i></button>
            </form>
        </div>

        <div class="col s12 m6 l1">

        </div>
    </div>

    <script>
        $(document).ready(function(){
            var elems = document.getElementsByClassName('modal delete');;
            var instance = M.Modal.init(elems[0]);
            $("a.modal-open-delete").click(function () {

                $("input#image_id").val($(this).data("imageid"));
                instance.open()
            })
        });

    </script>

    <script src="/js/simple-lightbox-activator.js"></script>




@endsection





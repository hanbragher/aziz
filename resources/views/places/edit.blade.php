@extends('layouts.layout')

@section('links')
    <link href="/css/simplelightbox.min.css" rel="stylesheet">
@endsection

@section('links_after')
    <script src="/js/simple-lightbox.min.js"></script>
@endsection

@section('content')
    <div class="fixed-action-btn ">
        <a class="btn-floating btn-large red" href="{{route('places.create')}}">
            <i class="large material-icons">mode_edit</i>
        </a>
    </div>

    <div class="row">
        <div class="col s12">
            @include('widgets.parallax', ['cover'=>'/images/parallax1690x300.jpg'])
            @include('inc.middlemenu', ['avatar'=>$place->image, 'header'=> '<a href="'.route('places.show', $place->id).'" target="blank"><i class="material-icons">open_in_new</i></a>' ])
        </div>
    </div>

    @include('inc.toast-notifications')

    <div class="col s12 m4 l1 hide-on-med-and-down"></div>
    </div>

    <div class="row">
        <div class="col s12 m12 l1 hide-on-med-and-down"></div>

        <div class="col s12 m12 l2 hide-on-med-and-down">
            @include('inc.mysidenav', ['active'=>'myplaces'])
        </div>

        <div class="col s12 m12 l8">
            <div class="row">

                <!-- Modal Structure -->
                <div class="modal delete">
                    <form action="{{route('places.update', $place->id)}}" method="post" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="modal-content">
                            <h4>Delete confirmation</h4>
                            <p>Do you want to remove image?</p>
                            <input id="image_id" name="image_id" value="" type="hidden">
                            <input id="place_id" name="place_id" value="" type="hidden">
                            <input name="destroy" value='destroy' type="hidden">
                        </div>
                        <div class="modal-footer">
                            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancel</a>
                            <button class="btn red">Delete</button>
                        </div>
                    </form>
                </div>

                <div class="modal title">
                    <form action="{{route('places.update', $place->id)}}" method="post" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="modal-content input-field">
                            <h4>Image title</h4>
                            <input id="image_id" name="image_id" value="" type="hidden">
                            <input id="place_id" name="place_id" value="" type="hidden">
                            <input name="set_title" value="set_title" type="hidden">
                            <input id="image_title" name="image_title" value="" placeholder="max 100 character" data-length="100">
                        </div>
                        <div class="modal-footer">
                            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancel</a>
                            <button class="btn">Save</button>
                        </div>
                    </form>
                </div>



                <form action="{{route('places.update', $place->id)}}" method="post" id="form" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="input-field col s12 m6 l6">
                            <input value='{{$place->name}}' id="place_name" type="text" data-length="100" name="name" required>
                            <label for="input_text">Place Name</label>
                        </div>
                        <div class="input-field col s12 m6 l6">
                            <i class="material-icons prefix">clear_all</i>
                            <select name="category">
                                <option value="" selected>Without category</option>
                                @php if(!empty($place->category)){$place_category_name = $place->category->name;}else{$place_category_name = null;}@endphp
                                @foreach($categories as $category)
                                        <option  value="{{$category}}" {{($category == $place_category_name)?'selected':''}}>{{$category}}</option>
                                @endforeach
                            </select>
                            <label>Select the Category</label>
                        </div>
                    </div>


                    <div class="row">
                        <div class="input-field col s12 m12 l4">
                            <i class="material-icons prefix">language</i>
                            <select name="country">
                                <option value="Armenia" selected>Armenia</option>
                            </select>
                            <label>Country</label>
                        </div>

                        <div class="input-field col s12 m12 l4">
                            <i class="material-icons prefix">explore</i>
                            <select name="region">
                                <option value="" disabled selected>Choose from list</option>
                                @php if(!empty($place->region)){$place_region_name = $place->region->name;}else{$place_region_name = null;}@endphp
                                @foreach($regions as $region)
                                    <option value="{{$region}}" {{($region == $place_region_name)?'selected':''}}>{{$region}}</option>
                                @endforeach
                            </select>
                            <label>State/Region</label>
                        </div>

                        <div class="col s12 m12 l4">
                            <div class="row">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix">gps_fixed</i>
                                    @php if(!empty($place->city)){$place_city_name = $place->city->name;}else{$place_city_name = null;}@endphp
                                    <input type="text" id="city" name='city' class="autocomplete" placeholder="Type and select" value="{{$place_city_name}}">
                                    <label for="state">City</label>
                                </div>
                            </div>
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
                            @if(12-($images_count = $place->images->count()) > 0)

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


                    @if($place->images->first())
                        <div class="row ">
                            @foreach($place->images as $image)
                                <div class="col col s6 m3 l2">
                                    <div class="card">
                                        <div class="card-image waves-effect waves-block waves-light gallery">
                                            <a href="{{$image->file}}" class="big" >
                                                <img class="" src="{{$image->thumb}}" title="{{$image->title}}">
                                            </a>
                                        </div>
                                        <a data-imageid='{{$image->id}}' data-placeid='{{$place->id}}' data-imagetitle='{{$image->title}}' href="#!" class="modal-open-title truncate grey-text center" ><i class="material-icons tiny">create</i>{{!empty($image->title)?$image->title:'Add title'}}</a>

                                        <p><a class="teal-text" href="{{$image->file}}" download><i class="material-icons">file_download</i></a></p>
                                        <a data-imageid='{{$image->id}}' data-placeid='{{$place->id}}' href="#!" class="modal-open-delete btn-floating halfway-fab waves-effect waves-light red" ><i class="material-icons">delete_forever</i></a>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    @endif



                    <div class="row">
                        <div class="input-field col s12">
                            <textarea id="textarea1" class="materialize-textarea" name="map"></textarea>
                            <label for="textarea1">Map frame (from google or yandex)</label>
                        </div>
                    </div>

                    <div class="row">
                        {!! $place->map !!}
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <textarea  id="textarea1" class="materialize-textarea" name="inf" required>{{$place->inf}}</textarea>
                            <label for="textarea1">Information</label>
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
            var elems = document.getElementsByClassName('modal delete');
            var instance = M.Modal.init(elems[0]);
            $("a.modal-open-delete").click(function () {

                $("input#image_id").val($(this).data("imageid"));
                $("input#place_id").val($(this).data("placeid"));
                instance.open()
            });

        $(document).ready(function(){
            var elems = document.getElementsByClassName('modal title');
            var instance = M.Modal.init(elems[0]);
            $("a.modal-open-title").click(function () {

                $("input#image_id").val($(this).data("imageid"));
                $("input#place_id").val($(this).data("placeid"));
                $("input#image_title").val($(this).data("imagetitle"));
                instance.open()
            });
        });

            $(document).ready(function(){
                $('select').formSelect();
            });

            $('#form').on('keyup keypress', function(e) {
                var keyCode = e.keyCode || e.which;
                if (keyCode === 13) {
                    e.preventDefault();
                    return false;
                }
            });


            $('input#place_name').characterCounter();


            $('input#city').autocomplete({
                data: {
                    @foreach($cities as $city)
                    '{{$city}}': null,
                    @endforeach
                }
            });




            $('.chips-autocomplete').chips({
                placeholder: 'Enter a tag',
                secondaryPlaceholder: '+Tag',
                data: [
                        @foreach($place->tags as $tag)
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
        });

    </script>
    <script src="/js/add-tags-on-submit-form.js"></script>



@endsection





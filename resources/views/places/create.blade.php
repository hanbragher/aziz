@extends('layouts.layout')

@section('content')

    <div class="row">
        <div class="col s12">
            @include('widgets.parallax', ['cover'=>$user->cover])
            @include('inc.middlemenu', ['avatar'=>$user->avatar, 'header'=>'New place'])
        </div>
    </div>

    @include('inc.toast-notifications')

    <div class="col s12 m4 l1 hide-on-med-and-down"></div>
    </div>

    <div class="row">
        <div class="col s12 m12 l1 hide-on-med-and-down"></div>

        <div class="col s12 m12 l2 hide-on-med-and-down">
            @include('inc.mysidenav', ['active'=>'newplace'])
        </div>

        <div class="col s12 m12 l8">
            <form action="{{route('places.store')}}" method="post" id="form" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="input-field col s12 m6 l6">
                        <input value='{{old("name")}}' id="place_name" type="text" data-length="100" name="name" required>
                        <label>Place Name</label>
                    </div>

                    <div class="input-field col s12 m6 l6">
                        <i class="material-icons prefix">clear_all</i>
                        <select name="category">
                            <option value="" selected>Without category</option>
                            @foreach($categories as $category)
                                <option  value="{{$category}}">{{$category}}</option>
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
                            @foreach($regions as $region)
                                <option value="{{$region}}">{{$region}}</option>
                            @endforeach
                        </select>
                        <label>State/Region</label>
                    </div>

                    <div class="col s12 m12 l4">
                        <div class="row">
                            <div class="input-field col s12">
                                <i class="material-icons prefix">gps_fixed</i>
                                <input type="text" id="city" name='city' class="autocomplete" placeholder="Type and select">
                                <label for="state">City</label>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="file-field input-field col s5">
                        <div class="btn">
                            <span>Main image</span>
                            <input type="file" name="main_image" accept="image/*">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" placeholder="set main photo" >
                            <label>max 2MB</label>
                        </div>
                    </div>
                    <div class="file-field input-field col s7">
                        <div class="btn">
                            <span>Gallery photos</span>
                            <input type="file" name="gallery[]" multiple accept="image/*">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" placeholder="up to 12 images into gallery" >
                            <label>max 2MB each</label>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">map</i>
                        <textarea id="textarea1" class="materialize-textarea" name="map" required>{{old("map")}}</textarea>
                        <label for="textarea1">Map frame (from google or yandex)</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <textarea id="textarea2" class="materialize-textarea" name="inf" required>{{old("inf")}}</textarea>
                        <label for="textarea2">Information</label>
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





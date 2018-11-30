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
            @include('widgets.parallax', ['cover'=>'/images/places_cover.jpg'])

            @include('inc.middlemenu', ['avatar'=> 'hide', 'header'=>!empty($place_menu) ? $place_menu : 'all'])
        </div>
    </div>
    <div class="col s12 m4 l1 hide-on-med-and-down"></div>
    </div>

    <div class="row">
        <div class="col s12 m12 l1 hide-on-med-and-down"></div>

        <div class="col s12 m12 l2 hide-on-med-and-down">
            @include('inc.places_sidenav', ['active'=> !empty($place_menu) ? $place_menu : 'all'])
        </div>

        <div class="col s12 m12 l8">

            <div class="row">
                <div class="col s12">
                    <ul class="tabs">
                        <li class="tab col s3"><a href="#inf">Inf</a></li>
                        <li class="tab col s3"><a href="#pictures" class="active">Pictures</a></li>
                        <li class="tab col s3"><a href="#map">Map</a></li>
                        <li class="tab col s3"><a href="#notes">Notes</a></li>
                    </ul>
                </div>

                <div id="inf" class="col s12">{!! $place->inf !!}</div>

                <div id="pictures" class="col s12">

                    @foreach($place->images as $image_source)
                        <div class="gallery col s6 m4 l3">
                            @include('inc.place_gallery',
                                [
                                    'image'=>$image_source->file,
                                    'thumb'=>$image_source->thumb,
                                    'title'=>$image_source->title
                                ])
                        </div>
                    @endforeach

                </div>

                <div id="map" class="col s12">
                    {!!$place->map!!}
                </div>

                <div id="notes" class="col s12">
                    <div class="row">

                            <ul class="collapsible">
                                <li class="{{$errors->all()?"active":''}}" id="note">
                                    <div class="collapsible-header" id="note_header"><i class="material-icons teal-text">arrow_drop_down</i>Write a note</div>
                                    <div class="collapsible-body" id="note_body">
                                        <form action="{{route('notes.store')}}" method="post" id="form" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="input-field col s12">
                                                    <textarea class="materialize-textarea" name="text">{{old("text")}}</textarea>
                                                    <label for="textarea1">Textarea</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="file-field input-field col s12 m12 l12">
                                                    <div class="btn">
                                                        <span>Attach photos</span>
                                                        <input type="file" name="photos[]" multiple accept="image/*">
                                                    </div>
                                                    <div class="file-path-wrapper">
                                                        <input class="file-path validate" placeholder="Attach up to 12 images" >
                                                        <label>max 2MB each</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <button class="btn" >Publish<i class="material-icons right">send</i></button>
                                        </form>

                                    </div>
                                </li>

                            </ul>




                    </div>

                    <div class="row">
                        @include('inc.note')
                    </div>


                </div>
            </div>
        </div>

        <div class="col s12 m6 l1">

        </div>
    </div>

    <script src="/js/simple-lightbox-activator.js"></script>

    @auth
        @if($user->id != $place->user->id)
            <script>
                $(document).ready(function(){
                    var hashValue = location.hash;
                    hashValue = hashValue.replace(/^#/, '');
                    console.log(hashValue);
                    if (hashValue == 'notes'){
                        document.getElementById('note_body').style.cssText = 'display: block;';
                        document.getElementById('note').classList.add('active');
                    }
                });
            </script>
        @endif
    @endauth




@endsection





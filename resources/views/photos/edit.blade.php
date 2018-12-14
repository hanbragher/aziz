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
            @include('widgets.parallax', ['cover'=>$user->cover])
            @include('inc.middlemenu', ['avatar'=>$user->avatar, 'header'=>'Edit photo'])
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

                <div class="gallery">
                        @include('inc.photo_card', [
                        'star'=> $user->favoritePhotos->contains($photo->id),
                        'photo'=>$photo,
                        ])

                </div>

                <div class="col s12 m8 l8 ">


                    <form action="{{route('photos.update', $photo->id)}}" method="post" id="form" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="row">
                            <div class="input-field">
                                <input value='{{$photo->title}}' id="input_text" type="text" data-length="100" name="title" >
                                <label>Title</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="file-field input-field">
                                <div class="btn">
                                    <span>Change a photo</span>
                                    <input type="file" name="photo" accept="image/*">
                                </div>
                                <div class="file-path-wrapper">
                                    <input class="file-path validate" placeholder="upload a new photo" >
                                    <label>max 4MB</label>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="chips chips-autocomplete">
                            </div>
                        </div>


                        <button class="btn" >Update<i class="material-icons right">send</i></button>

                    </form>

                </div>

            </div>
        </div>
        <div class="col s12 m6 l1">

        </div>

    </div>

    <script src="/js/simple-lightbox-activator.js"></script>

    <script>


        $(document).ready(function() {
            $('input#input_text, textarea#textarea2').characterCounter();
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
                    @foreach($photo->tags as $tag)
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

    <script src="/js/set-favorite.js"></script>
    <script src="/js/add-tags-on-submit-form.js"></script>


@endsection





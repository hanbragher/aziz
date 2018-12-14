@extends('layouts.layout')

@section('content')

    <div class="row">
        <div class="col s12">
            @include('widgets.parallax', ['cover'=>$user->cover])
            @include('inc.middlemenu', ['avatar'=>$user->avatar, 'header'=>'New photo'])
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
            <form action="{{route('photos.store')}}" method="post" id="form" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="input-field col s12 m12 l6">
                        <input value='{{old("title")}}' id="input_text" type="text" data-length="100" name="title">
                        <label>Title</label>
                    </div>
                </div>

                <div class="row">
                    <div class="file-field input-field col s12 m12 l6">
                        <div class="btn">
                            <span>Choose a photo</span>
                            <input type="file" name="photo" accept="image/*" required>
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" placeholder="upload a photo" >
                            <label>max 4MB</label>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col s12 m12 l6 ">
                        <div class="chips chips-autocomplete">
                        </div>
                    </div>
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
            data: [
                @if(!empty(old('tags')))
                    @foreach(json_decode(old('tags')) as $tag)
                        {tag: '{{$tag->tag}}',},
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





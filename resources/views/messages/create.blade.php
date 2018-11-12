@extends('layouts.layout')

@section('content')

    <div class="row">
        <div class="col s12">
            @include('widgets.parallax', ['cover'=>$user->cover])
            @include('inc.middlemenu', ['avatar'=>$user->avatar, 'header'=>'New message'])
        </div>
    </div>

    @include('inc.notifications')

    <div class="col s12 m4 l1 hide-on-med-and-down"></div>
    </div>

    <div class="row">
        <div class="col s12 m12 l1 hide-on-med-and-down"></div>

        <div class="col s12 m12 l2 hide-on-med-and-down">
            @include('inc.mysidenav', ['active'=>'newmessege'])
        </div>

        <div class="col s12 m12 l8">
            <form action="{{route('messages.store')}}" method="post" id="form" enctype="multipart/form-data">
                @csrf


                <div class="row">
                    <div class="input-field col s12 m6 l6">
                        <input value='{{old("to")}}' id="to" type="email" data-length="100" name="to" required>
                        <label>TO</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12 m6 l6">
                        <input value='{{old("title")}}' id="input_text" type="text" data-length="100" name="title" required>
                        <label>Title</label>
                    </div>
                    <div class="file-field input-field col s12 m6 l6">
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


                <div class="row">
                    <div class="input-field col s12">
                        <textarea id="textarea1" class="materialize-textarea" name="text">{{old("text")}}</textarea>
                        <label for="textarea1">Textarea</label>
                    </div>
                </div>


                <button class="btn" >Send<i class="material-icons right">send</i></button>

            </form>



        </div>
        <div class="col s12 m6 l1">

        </div>

    </div>
    <script>
        $(document).ready(function() {
            $('input#input_text, textarea#textarea2').characterCounter();
        });



    </script>

@endsection





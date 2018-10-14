@extends('layouts.layout')

@section('links')

@endsection

@section('content')
    <div class="row">
        <div class="col s12">
            @include('widgets.parallax')
            @include('inc.middlemenu')
        </div>
    </div>
    <div class="col s12 m4 l1 hide-on-med-and-down">

    </div>

    <div class="row">
        <div class="col s12 m12 l1 hide-on-med-and-down"></div>

        <div class="col s12 m12 l2">
            @include('inc.mysidenav', ['active'=>'mysettings'])
        </div>

        <div class="col s12 m12 l8">

            <form action="/test" method="post">
                @csrf
                <div class="row">
                    <div class="input-field col s4">
                        <input id="input_text" type="text" data-length="100" name="first_name">
                        <label for="input_text">First Name</label>
                    </div>
                    <div class="input-field col s4">
                        <input id="input_text" type="text" data-length="100" name="last_name">
                        <label for="input_text">Last Name</label>
                    </div>
                </div>

                <div class="row">
                    <div class="file-field input-field col s6 m6 l4">
                        <div class="btn">
                            <span>Avatar</span>
                            <input type="file">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate"  name="avatar" placeholder="your avatar" >
                        </div>
                    </div>
                    <div class="file-field input-field col s6 m6 l4">
                        <div class="btn">
                            <span>Cover image</span>
                            <input type="file">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate"  name="cover" placeholder="your cover image" >
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s6 m6 l4">
                        <input value="Alvin" id="input_text" type="text" data-length="100" name="blog_name">
                        <label for="input_text">Blog Name</label>
                    </div>
                    <div class="file-field input-field col s6 m6 l4">
                        <div class="btn">
                            <span>Blog Cover image</span>
                            <input type="file">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate"  name="cover" placeholder="blog cover image" >
                        </div>
                    </div>
                </div>

                <div class="row">
                    <label>
                        <input id="indeterminate-checkbox" type="checkbox" name="check" checked="checked"/>
                        <span>I'm a blogger</span>
                    </label>
                </div>
                <button class="btn">Save<i class="material-icons right">save</i></button>
            </form>

            <a class="waves-effect waves-light modal-trigger" href="#modal1">
                <blockquote>
                    *cover image requirements
                </blockquote>
            </a>
        </div>
        <div class="col s12 m6 l1">
        </div>
    </div>


    <div id="modal1" class="modal">
        <div class="modal-content">
            <h4>Cover image requirements</h4>
            {{--<p>A bunch of text</p>--}}
            <img class="materialboxed z-depth-3" width="300" src="/images/parallax1.jpg">
        </div>
        <div class="modal-footer">
            <a class="btn left" href="/images/test.jpg" download>Download<i class="material-icons right">file_download</i></a>

            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Ok</a>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $('.modal').modal();
        });
    </script>


@endsection





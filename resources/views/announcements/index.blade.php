@extends('layouts.layout')

@section('content')

    <div class="row">
        <div class="col s12">
            @include('widgets.home_slider')
            @include('inc.tag-search-bar', ['route'=>route('announcements.index')])
        </div>

    </div>

    @include('inc.notifications')


    <div class="modal delete">
        <form action="/" method="post" id="delete_announcement_form" enctype="multipart/form-data">
            @method('DELETE')
            @csrf
            <div class="modal-content">
                <h4>Delete confirmation</h4>
                <p>Do you want to delete this message?</p>
            </div>
            <div class="modal-footer">
                <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancel</a>
                <button class="btn red">Delete</button>
            </div>
        </form>
    </div>



    <div class="row">
        <div class="col s12 m4 l1 hide-on-med-and-down"></div>

        <div class="col s12 m12 l10">

            @foreach($announcements as $announcement)
                <div class="col s12 m12 l6 ">
                    {{--@auth

                    @else

                    @endauth--}}
                    @include('inc.announcement', ['star'=>true])
                </div>
            @endforeach

        </div>

        <div class="col s12 m4 l1 hide-on-med-and-down"></div>
    </div>

    <div class="row center">
        {{$announcements->appends($_GET)->links()}}
    </div>


    <script src="/js/slider_mini_script.js"></script>



@endsection
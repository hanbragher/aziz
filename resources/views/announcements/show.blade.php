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
            @include('widgets.home_slider')
        </div>
    </div>

    @include('inc.notifications')

    @auth
        <div id='modal-reply' class="modal">
            <form action="{{route('messages.store')}}" method="post" id="form1" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <h4>Reply</h4>
                    <input name="announcement_id" value="{{$announcement->id}}" type="hidden">
                    <div class="input-field">
                        <input id="title" name="title" value="RE: {{$announcement->title}}" placeholder="max 100 character" data-length="100">
                    </div>
                    <div class="input-field">
                        <input name="text" value="" placeholder="type your message" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancel</a>
                    <button class="btn">Send<i class="material-icons right">send</i></button>
                </div>
            </form>
        </div>
    @else
        <div id='modal-reply' class="modal">
                <div class="modal-content">
                    <h4 class="center">Please log in before reply</h4>
                </div>
                <div class="modal-footer">
                    <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancel</a>
                    <a href="{{route('login')}}" class="btn">Log in</a>
                </div>
        </div>
    @endauth

    <div class="row">
        <div class="col s12 m4 l1 hide-on-med-and-down"></div>

        <div class="col s12 m12 l10">
            @include('inc.show', ['data'=> $announcement])
        </div>
        {{--<a data-title='{{$announcement->title}}' href="#modal-reply" class="modal-trigger truncate grey-text center" ><i class="material-icons tiny">create</i>fbdfhdfh</a>--}}

        <div class="col s12 m4 l1 hide-on-med-and-down"></div>

    </div>

    <script src="/js/slider_mini_script.js"></script>

    <script>
        $(document).ready(function() {
            $('input#title').characterCounter();
        });

        $(document).ready(function(){
            $('.modal').modal();
            var hashValue = location.hash;
            hashValue = hashValue.replace(/^#/, '');
            if (hashValue == 'modal-reply'){
                $('.modal').modal('open');
            }
        });

    </script>



@endsection
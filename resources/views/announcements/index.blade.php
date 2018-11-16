@extends('layouts.layout')

@section('content')

    <div class="row">
        <div class="col s12">
            @include('widgets.home_slider')
            @include('inc.tag-search-bar', ['route'=>route('announcements.index')])
        </div>

    </div>

    @include('inc.notifications')


    <div class="row">
        <div class="col s12 m4 l1 hide-on-med-and-down"></div>

        <div class="col s12 m12 l10">
            @guest
                @php $star =  false;  @endphp
                <div id='modal-reply' class="modal">
                    <div class="modal-content">
                        <h4 class="center">Please log in before</h4>
                    </div>
                    <div class="modal-footer">
                        <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancel</a>
                        <a href="{{route('login')}}" class="btn">Log in</a>
                    </div>
                </div>
            @endguest



            @foreach($announcements as $announcement)
                <div class="col s12 m12 l6 ">
                    @auth
                        @php $star =  $user->favoriteAnnouncements->contains($announcement->id) @endphp
                    @endauth
                    @include('inc.announcement', [
                           'starable' => true,
                           'star'=>$star])
                </div>
            @endforeach

        </div>

        <div class="col s12 m4 l1 hide-on-med-and-down"></div>
    </div>

    <div class="row center">
        {{$announcements->appends($_GET)->links()}}
    </div>


    <script src="/js/slider_mini_script.js"></script>
    <script src="/js/set-favorite.js"></script>


    <script>
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
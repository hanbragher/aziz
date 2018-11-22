@extends('layouts.layout')

@section('content')

    <div class="row">
        <div class="col s12">
            @include('widgets.home_slider')
            @include('inc.tag-search-bar', ['route'=>route('announcements.index')])
        </div>

    </div>

    @include('inc.toast-notifications')


    <div class="row">
        <div class="col s12 m4 l1 hide-on-med-and-down"></div>

        <div class="col s12 m12 l10">

            @if($announcements->first())
                @guest
                @php $star =  false;  @endphp
                @include('inc.modal-please-login')
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

            @else
                <p class="flow-text center">No announcements</p>
            @endif


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
        });
    </script>


@endsection
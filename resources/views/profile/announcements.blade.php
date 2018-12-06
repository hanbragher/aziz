@extends('layouts.layout')

@section('content')
    <div class="row">
        <div class="col s12">
            @include('widgets.parallax', ['cover'=>$show_user->cover])
            @include('inc.middlemenu', ['avatar'=>$show_user->avatar, 'header'=>'Posts'])
        </div>
    </div>

    @include('inc.toast-notifications')

    <div class="col s12 m4 l1 hide-on-med-and-down"></div>
    </div>

    <div class="row">
        <div class="col s12 m12 l1 hide-on-med-and-down"></div>

        <div class="col s12 m12 l2">
            @include('inc.usersidenav', ['active'=>'user_announcements'])
        </div>

        <div class="col s12 m12 l8">
            <div class="row">
                    @if($show_user->announcements->first())
                        @guest
                        @php $star =  false;  @endphp
                        @include('inc.modal-please-login')
                        @endguest

                        @foreach($show_user->announcements as $announcement)
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
        </div>

        <div class="col s12 m6 l1">

        </div>
    </div>
    <script src="/js/set-favorite.js"></script>


@endsection





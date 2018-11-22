@extends('layouts.layout')

@section('content')
    <div class="row">
        <div class="col s12">
            @include('widgets.parallax', ['cover'=>$user->cover])
            @include('inc.middlemenu', ['avatar'=>$user->avatar, 'header'=>'Favorite announcements'])
        </div>
    </div>

    @include('inc.toast-notifications')

    <div class="col s12 m4 l1 hide-on-med-and-down"></div>
    </div>

    <div class="row">
        <div class="col s12 m12 l1 hide-on-med-and-down"></div>

        <div class="col s12 m12 l2 hide-on-med-and-down">
            @include('inc.mysidenav', ['active'=>'favorite'])
        </div>

        <div class="col s12 m12 l8">

            @include('inc.favorite-selector-bar', ['active'=>$active])

            <div class="row">
                @if($announcements->first())
                    @foreach($announcements as $announcement)
                        <div class="col s12 m12 l6 ">
                            @include('inc.announcement', [
                                        'starable' => true,
                                        'star'=> $user->favoriteAnnouncements->contains($announcement->id),
                                        'announcement' => $announcement,
                                        'editable'=>false
                                        ])
                        </div>
                    @endforeach
                @else
                    <p class="flow-text center">No Announcements</p>
                @endif
            </div>

            <div class="row center">
                {{$announcements->appends($_GET)->links()}}
            </div>


        </div>

        <div class="col s12 m6 l1">

        </div>
    </div>

    <script src="/js/set-favorite.js"></script>



@endsection





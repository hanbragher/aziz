@extends('layouts.layout')

@section('content')
    <div class="row">
        <div class="col s12">
            @include('widgets.parallax', ['cover'=>$show_user->cover])
            @include('inc.middlemenu', ['avatar'=>$show_user->avatar, 'header'=>$show_user->first_name.' '.$show_user->last_name])

        </div>
    </div>
    <div class="col s12 m4 l1 hide-on-med-and-down">

    </div>

    <div class="row">
        <div class="col s12 m12 l1 hide-on-med-and-down"></div>

        <div class="col s12 m12 l2">
            @include('inc.usersidenav', ['active'=>'owner_page'])
        </div>

        <div class="col s12 m12 l8">

            <h5>
                {{$show_user->first_name}} {{$show_user->last_name}}
            </h5>

            <a href="{{route('messages.create', ['email'=>$show_user->email])}}" class="btn">send message</a>


            @if($qnt = $show_user->totalPlaces() > 0)
                <div class="col s12">
                    <div class="card horizontal">
                        <div class="card-image">
                            {{--<img src="/images/card.jpg">--}}
                        </div>
                        <div class="card-stacked">
                            <div class="card-content">
                                <p>Total places count: {{$qnt}}</p>
                            </div>
                            <div class="card-action">
                                <a href="{{route('profile.places', $show_user->id)}}">Jump to places</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if($qnt = $show_user->totalPosts() > 0)
                <div class="col s12">
                    <div class="card horizontal">
                        <div class="card-image">
                            {{--<img src="/images/card.jpg">--}}
                        </div>
                        <div class="card-stacked">
                            <div class="card-content">
                                <p>Total posts count: {{$qnt}}</p>
                            </div>
                            <div class="card-action">
                                <a href="{{route('profile.posts', $show_user->id)}}">Jump to blog</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="col s12">
                <div class="card horizontal">
                    <div class="card-image">
                        {{--<img src="/images/card.jpg">--}}
                        {{--<i class="material-icons">add</i>--}}
                    </div>
                    <div class="card-stacked">
                        <div class="card-content">
                            <p>Total photos count: {{$show_user->totalPhotos()}}</p>
                        </div>
                        <div class="card-action">
                            <a href="{{route('profile.photos', $show_user->id)}}">Jump to photos</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col s12">
                <div class="card horizontal">
                    <div class="card-image">
                        {{--<img src="/images/card.jpg">--}}
                        {{--<i class="material-icons">add</i>--}}
                    </div>
                    <div class="card-stacked">
                        <div class="card-content">
                            <p>Total notes count: {{$show_user->totalNotes()}}</p>
                        </div>
                        <div class="card-action">
                            <a href="{{route('profile.notes', $show_user->id)}}">Jump to notes</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col s12">
                <div class="card horizontal">
                    <div class="card-image">
                        {{--<img src="/images/card.jpg">--}}
                        {{--<i class="material-icons">add</i>--}}
                    </div>
                    <div class="card-stacked">
                        <div class="card-content">
                            <p>Total announcements count: {{$show_user->totalNotes()}}</p>
                        </div>
                        <div class="card-action">
                            <a href="{{route('profile.announcements', $show_user->id)}}">Jump to announcements</a>
                        </div>
                    </div>
                </div>
            </div>


{{--
            <a href="{{route('profile.posts', $show_user->id)}}" class="collection-item @if($active == 'user_posts') active @endif ">Posts</a>
            <a href="{{route('profile.notes', $show_user->id)}}" class="collection-item @if($active == 'user_notes') active @endif ">Notes</a>
            <a href="{{route('profile.announcements', $show_user->id)}}" class="collection-item @if($active == 'user_announcements') active @endif ">Announcements</a>

--}}


        </div>

        <div class="col s12 m6 l1">

        </div>
    </div>

@endsection





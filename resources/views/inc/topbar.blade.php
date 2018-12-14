<div class="navbar-fixed">
<nav>
    <div class="nav-wrapper teal lighten-1">
        <div class="row">
            <div class="col s6 m4 l1">
                <a href="#" data-target="mobile-menu" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                @auth
                <a href="{{route('notifications.index')}}" class="sidenav-trigger {{($user->hasNewNotification())?'orange lighten-2':''}} {{(!empty($active) and $active == 'notifications')?'teal':''}}"><i class="material-icons">priority_high</i></a>
                @endauth

            </div>
            <div class="col s3 m4 l10 hide-on-small-only">
                <a href="/" class="brand-logo ">Logo</a>
                <ul class="right hide-on-med-and-down">
                    @auth
                        <li><a href="{{route('notifications.index')}}" class=" {{($user->hasNewNotification())?'orange lighten-2':''}} {{(!empty($active) and $active == 'notifications')?'teal':''}}"><i class="material-icons">priority_high</i></a></li>
                    @endauth

                    <li><a href="{{route('places.index', ['places'=>'all'])}}" class="{{(!empty($active_menu) and $active_menu == 'places')?'teal':''}}">Explore</a></li>
                    <li><a href="{{route('photos.index')}}" class="{{(!empty($active_menu) and $active_menu == 'photos')?'teal':''}}">Photos</a></li>
                    <li><a href="{{route('posts.index')}}" class="{{(!empty($active_menu) and $active_menu == 'posts')?'teal':''}}">Posts</a></li>
                    <li><a href="{{route('announcements.index')}}" class="{{(!empty($active_menu) and $active_menu == 'announcements')?'teal':''}}">Announcements</a></li>
                    @auth
                        <li><a class='btn' href='{{route('profiles.overview')}}'><i class="material-icons">account_circle</i></a></li>
                    @else
                        <li><a href="{{route('login')}}" class="white black-text">Log in</a></li>
                        <li><a href="{{route('register')}}">Sign up</a></li>
                    @endauth
                    <li><a class='dropdown-trigger btn' href='#' data-target='dropdown_lang'><i class="material-icons">language</i></a></li>

                    @auth
                        <li><a href="{{ route('logout') }}" >Log out</a></li>
                    @endauth

                </ul>
            </div>
            <div class="col s6 m4 l1">
                <a href="#" data-target="slide-out" class="sidenav-trigger right"><i class="material-icons">account_circle</i></a>
            </div>
        </div>
    </div>
</nav>
</div>



<ul id="slide-out" class="sidenav right">
    @auth
    <li>
        <div class="user-view">
            <div class="background" >
                <img  src="/images/mobile_cover.jpg">
            </div>
            <a href="#user"><img class="circle" src="{{ $user->thumb}}"></a>
            <a href="#name"><span class="white-text name">{{$user->first_name}} {{$user->last_name}}</span></a>
            <a href="#email"><span class="white-text email">{{$user->email}}</span></a>
            <a href="{{ route('logout') }}" >Log out</a>
    </div>
    </li>
    @include('inc.mysidenav', ['active'=>!empty($active_menu) ? $active_menu : 'null'])
    @else
        <li><a href="{{route('login')}}">Log in</a></li>
        <li><a href="{{route('register')}}">Sign up</a></li>
    @endauth
        <li><a class='dropdown-trigger btn' href='#' data-target='dropdown_lang_m'>Language</a></li>
</ul>






<ul class="sidenav left collapsible" id="mobile-menu" >
    <li class="hide-on-med-and-up">
        <a href="/" class="brand-logo ">Logo</a>
    </li>
    <li class="active">
        <div class="collapsible-header center"><i class="material-icons">explore</i>Explore<i class="material-icons">arrow_drop_down</i> </div>
        <div class="collapsible-body">
            @include('inc.places_sidenav', ['active'=>!empty($place_menu) ? $place_menu : 'null'])
        </div>
    </li>
    <li>
        <div class="divider"></div>
    </li>
    <li>
        <div class="sidenav-item black-text {{(!empty($active_menu) and $active_menu == 'photos')?'grey lighten-3':''}}" >
            <a class='black-text' href="{{route('photos.index')}}">
                <i class="material-icons sidenav-icon">center_focus_weak</i>
                Photos
            </a>
        </div>
    </li>
    <li><div class="divider"></div></li>
    <li>
        <div class="sidenav-item black-text {{(!empty($active_menu) and $active_menu == 'posts')?'grey lighten-3':''}}" >
            <a class='black-text' href="{{route('posts.index')}}">
                <i class="material-icons sidenav-icon">wallpaper</i>
                Posts
            </a>
        </div>
    </li>
    <li><div class="divider"></div></li>
    <li>
        <div class="sidenav-item black-text {{(!empty($active_menu) and $active_menu == 'announcements')?'grey lighten-3':''}}" >
            <a class='black-text' href="{{route('announcements.index')}}">
                <i class="material-icons sidenav-icon">chat_bubble_outline</i>
                Announcements
            </a>
        </div>
    </li>
    <li><div class="divider"></div></li>

</ul>


<ul id='dropdown_lang' class='dropdown-content'>
    @include('inc.languages')
</ul>

<ul id='dropdown_lang_m' class='dropdown-content'>
    @include('inc.languages')
</ul>
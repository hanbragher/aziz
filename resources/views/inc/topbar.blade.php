<div class="navbar-fixed">
<nav>
    <div class="nav-wrapper teal lighten-1">
        <div class="row">
            <div class="col s4 m4 l2">
                <a href="#" data-target="mobile-menu" class="sidenav-trigger"><i class="material-icons">menu</i></a>
            </div>
            <div class="col s4 m4 l8">
                <a href="/" class="brand-logo">Logo</a>
                <ul class="right hide-on-med-and-down">
                    <li><a href="{{route('places.index', ['places'=>'all'])}}">Go Explore</a></li>
                    <li><a href="#">See Photos</a></li>
                    <li><a href="{{route('posts.index')}}">Read posts</a></li>
                    <li><a href="{{route('posts.index')}}">Advert</a></li>
                    @auth
                        <li><a class='btn' href='/mypage'><i class="material-icons">account_circle</i></a></li>
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
            <div class="col s4 m4 l2">
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
            <a href="#user"><img class="circle" src="{{ !empty($user->avatar) ? $user->avatar->file : '/images/user_avatar.png'}}"></a>
            <a href="#name"><span class="white-text name">{{$user->first_name}} {{$user->last_name}}</span></a>
            <a href="#email"><span class="white-text email">{{$user->email}}</span></a>
            <a href="{{ route('logout') }}" >Log out</a>
    </div>
    </li>
    @include('inc.mysidenav', ['active'=>null])
    @else
        <li><a href="{{route('login')}}">Log in</a></li>
        <li><a href="{{route('register')}}">Sign up</a></li>
    @endauth
        <li><a class='dropdown-trigger btn' href='#' data-target='dropdown_lang_m'>Language</a></li>
</ul>






<ul class="sidenav left collapsible" id="mobile-menu" >
    <li class="active">
        <div class="collapsible-header center"><i class="material-icons">explore</i>Explore<i class="material-icons">arrow_drop_down</i> </div>
        <div class="collapsible-body">
            @include('inc.places_sidenav', ['active'=>null])
        </div>
    </li>
    <li>
        <div class="divider"></div>
    </li>
    <li>
        <div class="collapsible-header black-text" >
            <a class='black-text' href="{{route('blogs.index')}}">
                <i class="material-icons ">wallpaper</i>
                Blog
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
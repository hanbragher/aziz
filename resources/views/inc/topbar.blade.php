<div class="navbar-fixed">
<nav>
    <div class="nav-wrapper teal lighten-1">
        <div class="row">
            <div class="col s4 m4 l2">
                <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
            </div>
            <div class="col s4 m4 l8">
                <a href="#!" class="brand-logo">Logo</a>
                <ul class="right hide-on-med-and-down">
                    <li><a href="/"><i class="material-icons">home</i></a></li>
                    <li><a href="/page"><i class="material-icons">explore</i></a></li>
                    <li><a href="/item"><i class="material-icons">place</i></a></li>
                    <li><a href="/blog"><i class="material-icons">wallpaper</i></a></li>
                    <li><a href="mobile.html"><i class="material-icons">add</i></a></li>
                    <li><a href="sass.html">Sass</a></li>
                    <li><a href="badges.html">Components</a></li>
                    <li><a href="#">Log in</a></li>
                    <li><a href="#">Sign in</a></li>
                    <li><a class='dropdown-trigger btn' href='#' data-target='dropdown_lang'><i class="material-icons">language</i></a></li>
                    <li><a class='dropdown-trigger btn' href='#' data-target='dropdown_profile'><i class="material-icons">account_circle</i></a></li>
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
    <li><div class="user-view">
            <div class="background">
                <img src="images/card.jpg">
            </div>
            <a href="#user"><img class="circle" src="images/card.jpg"></a>
            <a href="#name"><span class="white-text name">John Doe</span></a>
            <a href="#email"><span class="white-text email">jdandturk@gmail.com</span></a>
        </div></li>
    <li><a href="#!"><i class="material-icons">cloud</i>First Link With Icon</a></li>
    <li><a href="#!">Second Link</a></li>
    <li><div class="divider"></div></li>
    <li><a class="subheader">Subheader</a></li>
    <li><a class="waves-effect" href="#!">Third Link With Waves</a></li>
</ul>


<ul class="sidenav left" id="mobile-demo">
    <li><a href="/" >Name</a></li>
    <li><a href="/">Sass</a></li>
    <li><a href="/">Components</a></li>
    <li><a href="/">Javascript</a></li>
    <li><a href="/">Mobile</a></li>
</ul>


<ul id='dropdown_lang' class='dropdown-content'>
    <li><a href="#!">English</a></li>
    <li><a href="#!">Russian</a></li>
    <li><a href="#!">Armenian</a></li>
    <li><a href="#!">BarBar</a></li>
</ul>

<ul id='dropdown_profile' class='dropdown-content'>
    <li><a href="#!">one</a></li>
    <li><a href="#!">two</a></li>
    <li class="divider" tabindex="-1"></li>
    <li><a href="#!">three</a></li>
    <li><a href="#!"><i class="material-icons">view_module</i>four</a></li>
    <li><a href="#!"><i class="material-icons">cloud</i>five</a></li>
</ul>

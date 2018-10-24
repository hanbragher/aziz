<nav class="teal lighten-1">
    <div class="nav-wrapper">
        <div class="row">

            <div class="col col s1 m1 l2 ">
            </div>

            <div class="col s10 m10 l8 ">
                <ul>
                    @if(!empty($avatar->file) and $avatar != 'hide' )
                    <li><img class="materialboxed z-depth-3" height="64" src="{{$avatar == 'none' ? '/images/user_avatar.png' : $avatar->file}}"></li>
                    @elseif($avatar == 'none')
                    <li><img class="materialboxed z-depth-3" height="64" src="/images/user_avatar.png"></li>
                    @elseif(!empty($avatar) and $avatar != 'hide' )
                        <li><img class="materialboxed z-depth-3" height="64" src="{{$avatar}}"></li>
                    @endif
                    <li class="right">{{!empty($header)? $header : null}}</li>
                </ul>

            </div>
            <div class="col col s1 m1 l2 ">
            </div>

        </div>

    </div>
</nav>

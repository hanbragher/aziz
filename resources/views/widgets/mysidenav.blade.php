<div class="collection ">
    <a href="/mypage" class="collection-item @if($active == 'mypage') active @endif ">My page</a>
    <a href="{{route('posts.my')}}" class="collection-item @if($active == 'myposts') active @endif ">My posts</a>
    <a href="{{route('posts.create')}}" class="collection-item @if($active == 'newpost') active @endif ">New post</a>
    <a href="/messeges" class="collection-item @if($active == 'messeges') active @endif ">Messeges<i class="material-icons right">fiber_new</i></a>
    <a href="/mycomments" class="collection-item @if($active == 'mycomments') active @endif ">My comments</a>
    <a href="/settings" class="collection-item @if($active == 'settings') active @endif ">Profile settings</a>
</div>
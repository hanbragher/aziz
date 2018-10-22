<div class="collection ">
    <a href="/mypage" class="collection-item @if($active == 'mypage') active @endif ">My page</a>
    @if(!empty($user->blog) and $user->blog->posts->first())
        <a href="{{route('posts.my')}}" class="collection-item @if($active == 'myposts') active @endif ">My posts</a>
    @endif
    @if($user->is_blogger)
        <a href="{{route('posts.create')}}" class="collection-item @if($active == 'newpost') active @endif ">New post</a>
    @endif
    <a href="/messeges" class="collection-item @if($active == 'messeges') active @endif ">My messages<i class="material-icons right">fiber_new</i></a>
    <a href="{{route('notes.index')}}" class="collection-item @if($active == 'mynotes') active @endif ">My notes</a>
    <a href="{{route('profiles.edit', 1)}}" class="collection-item @if($active == 'mysettings') active @endif ">Profile settings</a>
</div>
<div class="collection">
    <a href="/mypage" class="collection-item @if($active == 'mypage') active @endif ">My page</a>
    <p class="collection-item"></p>

    @if(!empty($user->blog) and $user->blog->posts->first())
        <a href="{{route('posts.my')}}" class="collection-item @if($active == 'myposts') active @endif ">My posts</a>
    @endif
    @if($user->is_blogger)
        <a href="{{route('posts.create')}}" class="collection-item @if($active == 'newpost') active @endif ">New post</a>
    @endif
    {{--@if(!empty($user->places) and $user->places->first())
        <a href="{{route('posts.my')}}" class="collection-item @if($active == 'myposts') active @endif ">My posts</a>
    @endif
    @if($user->is_moderator)
        <a href="{{route('posts.create')}}" class="collection-item @if($active == 'newpost') active @endif ">New post</a>
    @endif--}}
    <p class="collection-item"></p>

    <a href="{{route('messages.create')}}" class="collection-item @if($active == 'newmessege') active @endif ">New message</a>
    <a href="{{route('messages.index')}}" class="collection-item @if($active == 'messeges') active @endif ">My messages @if($user->hasNewMessage()) <i class="material-icons right">fiber_new</i> @endif </a>
    <a href="{{route('notes.index')}}" class="collection-item @if($active == 'mynotes') active @endif ">My notes</a>

    <p class="collection-item"></p>

    <a href="{{route('photos.my')}}" class="collection-item @if($active == 'myphotos') active @endif ">My photos</a>
    <a href="{{route('photos.create')}}" class="collection-item @if($active == 'newphoto') active @endif ">New photo</a>
    <a href="{{route('favorites.photos')}}" class="collection-item @if($active == 'favoritesphotos') active @endif ">Favorites</a>

    <p class="collection-item"></p>

    <a href="{{route('announcements.my')}}" class="collection-item @if($active == 'myannouncements') active @endif ">My announcements</a>
    <a href="{{route('announcements.create')}}" class="collection-item @if($active == 'newannouncement') active @endif ">New announcement</a>
    <a href="{{route('favorites.announcements')}}" class="collection-item @if($active == 'favoritesannouncements') active @endif ">Favorites</a>

    <p class="collection-item"></p>
    <a href="{{route('profiles.edit', $user->id)}}" class="collection-item @if($active == 'mysettings') active @endif ">Profile settings</a>
</div>
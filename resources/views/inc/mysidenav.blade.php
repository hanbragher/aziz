<div class="collection">
    <a href="/mypage" class="collection-item @if($active == 'mypage') active @endif "><i class="material-icons">perm_identity</i> My page @if($user->hasNewNotification()) <i class="material-icons right">fiber_new</i> @endif</a>
    <p class="collection-item sidenav-divader"></p>

    <a href="{{route('favorites.index', ['photos'])}}" class="collection-item @if($active == 'favorite') active @endif "><i class="material-icons">star_border</i> Favorite</a>

    <p class="collection-item sidenav-divader"></p>


    @if(!empty($user->blog) and $user->blog->posts->first())
        <a href="{{route('posts.my')}}" class="collection-item @if($active == 'myposts') active @endif "><i class="material-icons">tv</i> My posts</a>
    @endif
    @if($user->is_blogger)
        <a href="{{route('posts.create')}}" class="collection-item @if($active == 'newpost') active @endif "><i class="material-icons">add_to_queue</i> New post</a>
    @endif
    <a href="{{route('notes.index')}}" class="collection-item @if($active == 'mynotes') active @endif "><i class="material-icons">chat_bubble_outline</i> My notes</a>

    {{--@if(!empty($user->places) and $user->places->first())
        <a href="{{route('posts.my')}}" class="collection-item @if($active == 'myposts') active @endif ">My posts</a>
    @endif
    @if($user->is_moderator)
        <a href="{{route('posts.create')}}" class="collection-item @if($active == 'newpost') active @endif ">New post</a>
    @endif--}}
    <p class="collection-item sidenav-divader"></p>

    <a href="{{route('messages.index', ['inbox'])}}" class="collection-item @if($active == 'messeges') active @endif "><i class="material-icons">mail_outline</i> My messages @if($user->hasNewMessage()) <i class="material-icons right">fiber_new</i> @endif </a>
    <a href="{{route('messages.create')}}" class="collection-item @if($active == 'newmessege') active @endif "><i class="material-icons">create</i> New message</a>

    <p class="collection-item sidenav-divader"></p>

    <a href="{{route('photos.my')}}" class="collection-item @if($active == 'myphotos') active @endif "><i class="material-icons">photo_library</i> My photos </a>
    <a href="{{route('photos.create')}}" class="collection-item @if($active == 'newphoto') active @endif "><i class="material-icons">add_a_photo</i> New photo</a>

    <p class="collection-item sidenav-divader"></p>

    <a href="{{route('announcements.my')}}" class="collection-item @if($active == 'myannouncements') active @endif "><i class="material-icons">library_books</i> My announcements</a>
    <a href="{{route('announcements.create')}}" class="collection-item @if($active == 'newannouncement') active @endif "><i class="material-icons">library_add</i> New announcement</a>

    <p class="collection-item sidenav-divader"></p>
    <a href="{{route('profiles.edit', $user->id)}}" class="collection-item @if($active == 'mysettings') active @endif "><i class="material-icons">build</i> Profile settings</a>
</div>
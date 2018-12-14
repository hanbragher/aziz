<div class="collection ">
    <a href="{{route('profiles.show', $show_user->id)}}" class="collection-item @if($active == 'owner_page') active @endif ">Owner page</a>
    {{--@if(!empty($user->blog) and $user->blog->posts->first())
        <a href="{{route('posts.my')}}" class="collection-item @if($active == 'myposts') active @endif ">My posts</a>
    @endif
    @if($user->is_blogger)
        <a href="{{route('posts.create')}}" class="collection-item @if($active == 'newpost') active @endif ">New post</a>
    @endif--}}
    {{--@if(!empty($user->places) and $user->places->first())
        <a href="{{route('posts.my')}}" class="collection-item @if($active == 'myposts') active @endif ">My posts</a>
    @endif
    @if($user->is_moderator)
        <a href="{{route('posts.create')}}" class="collection-item @if($active == 'newpost') active @endif ">New post</a>
    @endif--}}

    <a href="{{route('profile.places', $show_user->id)}}" class="collection-item @if($active == 'user_places') active @endif ">Places</a>
    <a href="{{route('profile.posts', $show_user->id)}}" class="collection-item @if($active == 'user_posts') active @endif ">Posts</a>
    {{--//todo--}}
    <a href="{{route('profile.photos', $show_user->id)}}" class="collection-item @if($active == 'user_photos') active @endif ">Photos</a>
    <a href="{{route('profile.notes', $show_user->id)}}" class="collection-item @if($active == 'user_notes') active @endif ">Notes</a>
    <a href="{{route('profile.announcements', $show_user->id)}}" class="collection-item @if($active == 'user_announcements') active @endif ">Announcements</a>
</div>

<div class="card">
    <div class="row card-content margin-bottom-0">
        <img src="{{$announcement->thumb}}"
                 height="150"
                 align="left"
                 vspace="5"
                 hspace="5">


        @if(!empty($star) and $star == true)
        <a href="#!" class="secondary-content right"><i class="material-icons orange-text">star_border</i></a>
        @endif

        <p class="flow-text center truncate">{{$announcement->title}} sdf sdf sd f sdf sdf sd f sdf sd f sdf </p>

            <p class="truncate">{{$announcement->text}}</p>


    </div>
    <div class="card-action">
    @if(!empty($editable) and $editable == true)
                <a href="{{route('announcements.edit', $announcement->id)}}" >Edit</a>
                <a href="{{route('announcements.show', $announcement->id)}}" >show</a>

            <form action="{{route('announcements.destroy', $announcement->id)}}" method="post">
                @method('DELETE')
                @csrf
                <button class="btn-floating halfway-fab waves-effect waves-light red" onclick="return confirm('remove announcement?')"><i class="material-icons">delete_forever</i></button>
            </form>


    @else
            <a href="{{route('announcements.show', $announcement->id)}}">show more</a>
            <a href="{{route('announcements.show', $announcement->id)}}">reply</a>

    @endif
    </div>
</div>




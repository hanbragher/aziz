<div class="col col s12 m4 l3">
    <div class="card">
        <div class="card-image waves-effect waves-block waves-light">
            @if(empty($editable))
                <span class="truncate place-header">Author: <a href="{{route('profiles.show', $place->user->id )}}" class="black-text" target="_blank">{{$place->user->first_name}} {{$place->user->last_name}} <i class="material-icons tiny">open_in_new</i></a></span>
            @endif

            @auth
                <a href="#!" data-type="place" data-id='{{$place->id}}' class="set-favorite secondary-content set-fav-place"><i class="material-icons {{($star)?'orange-text':''}}">star</i></a>
            @else
                <a href="#modal-please-login"  class="modal-trigger secondary-content set-fav-place"><i class="material-icons">star</i></a>
            @endauth
                    <a href="{{route('places.show', $place->id)}}"><img src="{{$place->thumb}}" alt=""></a>
        </div>

        <div class="card-content">

            @if(!empty($editable) and $editable == true)
                <a data-actionroute='{{route('places.destroy', $place->id)}}' class="modal-open-delete btn-floating halfway-fab waves-effect waves-light " ><i class="material-icons red">delete_forever</i></a>
                <span><a href="{{route('places.edit', $place->id)}}"><i class="material-icons ">edit</i></a></span>
                @include('inc.share-button', ['type'=>'icon', 'link'=>'#'])
                <i class="material-icons right card-title activator chip">expand_less</i>
            @else
                <a href="#" class="btn-floating halfway-fab waves-effect waves-light " ><i class="material-icons">share</i></a>
                <i class="material-icons right card-title activator chip">expand_less</i>
            @endif

            <p><i class="material-icons tiny orange-text">stars</i> {{$place->stars()}}</p>
            <p class="truncate">Date: {{$place->created_at}}</p>

            @auth
            @if($place->user->id == $user->id)
                {{--//todo notes--}}
                {{--@if($photo->comments()->first())
                    @if(empty($read_comments))
                        <a href='{{route('photos.comments', $photo->id)}}' class=" teal-text">Read comments @if($photo->hasNewComment()) <i class="material-icons tiny red-text">fiber_new</i> @endif</a>
                    @elseif($read_comments == 'inactive')
                        <a class=" grey-text">Read comments</a>
                    @endif
                @else
                    <a  class="add-modal-comment grey-text">No comments</a>
                @endif--}}
            @else
                <a href='#!' data-id="{{$place->id}}" data-type="place" class="add-modal-comment teal-text"><i class="material-icons tiny teal-text">create</i> Send comment</a>
            @endif
            @else
                <a href='#modal-please-login'  class="modal-trigger"><i class="material-icons tiny teal-text">create</i> Send comment</a>
                @endauth

        </div>

        <div class="card-reveal">
            <span class="card-title grey-text text-darken-4">{{$place->title}}<i class="material-icons right">close</i></span>
            @if($place->tags->first())
                <div class="divider"></div>
                <p>
                    @foreach($place->tags as $tag)
                        <a class="chip" href="{{route('places.index', ['tag'=>$tag->name])}}">{{$tag->name}}</a>
                    @endforeach
                </p>
            @endif
        </div>
    </div>
</div>

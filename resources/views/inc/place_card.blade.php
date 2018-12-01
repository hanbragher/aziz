<div class="col col s12 m4 l3">
    <div class="card">
        <div class="card-image waves-effect waves-block waves-light">
            @if(empty($editable))
                <span class="truncate place-header">Author: <a href="{{route('profiles.show', $place->user->id )}}" class="black-text" target="_blank">{{$place->user->first_name}} {{$place->user->last_name}} <i class="material-icons tiny">open_in_new</i></a></span>
            @else
                <span class="truncate place-header">{{$place->name}}</span>
            @endif

            @auth
                <a href="#!" data-type="place" data-id='{{$place->id}}' class="set-favorite secondary-content set-fav-place"><i class="material-icons {{($star)?'orange-text':''}}">star</i></a>
            @else
                <a href="#modal-please-login"  class="modal-trigger secondary-content set-fav-place"><i class="material-icons">star</i></a>
            @endauth
                <a href="{{route('places.show', $place->id)}}"><img src="{{$place->thumb}}" alt=""></a>
        </div>

        <div class="card-content card-second-part">

            @if(!empty($editable) and $editable == true)
                <a data-actionroute='{{route('places.destroy', $place->id)}}' class="modal-open-delete btn-floating halfway-fab waves-effect waves-light " ><i class="material-icons red">delete_forever</i></a>
                <span><a href="{{route('places.edit', $place->id)}}"><i class="material-icons ">edit</i></a></span>
                @include('inc.share-button', ['type'=>'icon', 'link'=>'#'])
                <i class="material-icons right card-title activator chip">expand_less</i>
            @else
                <span class="truncate">{{$place->name}}</span>

                <a href="#" class="btn-floating halfway-fab waves-effect waves-light " ><i class="material-icons">share</i></a>
                <i class="material-icons right card-title activator chip">expand_less</i>
            @endif

            @if($place->is_moderated)
                    <p><i class="material-icons tiny orange-text">stars</i> {{$place->stars()}}</p>
                @else
                    <p><i class="material-icons tiny red-text">donut_small</i> Not moderated</p>
            @endif
            <p class="truncate">Date: {{$place->created_at}}</p>

            @auth
                @if($place->user->id == $user->id)
                    @if($place->notes()->first())
                        <a href='{{route('places.readNotes', $place->id)}}' class=" teal-text">Read notes @if($place->hasNewNote()) <i class="material-icons tiny red-text">fiber_new</i> @endif</a>
                    @else
                        <a  class="add-modal-comment grey-text">No notes</a>
                    @endif
                @else
                    <a href='{{route('places.show', $place->id)}}#notes' class=" teal-text"><i class="material-icons tiny teal-text">create</i> Add note</a>
                @endif
            @else
                <a href='#modal-please-login'  class="modal-trigger"><i class="material-icons tiny teal-text">create</i> Add note</a>
            @endauth

        </div>

        <div class="card-reveal">
            <span class="card-title grey-text text-darken-4">{{$place->name}}<i class="material-icons right">close</i></span>
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

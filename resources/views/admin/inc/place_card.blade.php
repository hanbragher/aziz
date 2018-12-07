<div class="col col s12 m4 l3">
    <div class="card">
        <div class="card-image waves-effect waves-block waves-light">
                <span class="truncate place-header">Author: <a href="{{route('profiles.show', $place->user->id )}}" class="black-text" target="_blank">{{$place->user->first_name}} {{$place->user->last_name}} <i class="material-icons tiny">open_in_new</i></a></span>

                <a href="#!" data-type="place" data-id='{{$place->id}}' class="set-favorite secondary-content set-fav-place"><i class="material-icons {{($star)?'orange-text':''}}">star</i></a>

                <a href="{{route('places.show', $place->id)}}"><img src="{{$place->thumb}}" alt=""></a>
        </div>

        <div class="card-content card-second-part">


            <a data-actionroute='{{route('places.destroy', $place->id)}}' class="modal-open-delete btn-floating halfway-fab waves-effect waves-light " ><i class="material-icons red">delete_forever</i></a>
            <span><a href="{{route('places.edit', $place->id)}}" target="_blank"><i class="material-icons" >edit</i></a></span>
            @include('inc.share-button', ['type'=>'icon', 'link'=>'#'])

            <a href='#' data-actionroute='{{route('moderate.places', $place->id)}}' class="modal-open-moderate" ><i class="material-icons {{(!$place->is_moderated)?'green-text':'red-text'}}">done</i></a>

            <i class="material-icons right card-title activator chip">expand_less</i>

                <span class="truncate">{{$place->name}}</span>



            @if($place->is_moderated)
                    <p><i class="material-icons tiny orange-text">stars</i> {{$place->stars()}}</p>
            @else
                    <p><i class="material-icons tiny red-text">donut_small</i> Not moderated</p>
            @endif
            <p class="truncate">Date: {{$place->created_at}}</p>

                    @if($place->notes()->first())
                        <a href='{{route('places.readNotes', $place->id)}}' class=" teal-text">Read notes @if($place->hasNewNote()) <i class="material-icons tiny red-text">fiber_new</i> @endif</a>
                    @else
                        <a  class="add-modal-comment grey-text">No notes</a>
                    @endif


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

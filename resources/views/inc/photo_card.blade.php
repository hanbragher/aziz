<div class="col col s12 m4 l3">
    <div class="card">
        <div class="card-image waves-effect waves-block waves-light">
            @if(empty($editable))
                    <span class="truncate photo-header">Author: <a href="{{route('profiles.show', $photo->user->id )}}" class="black-text" target="_blank">{{$photo->user->first_name}} {{$photo->user->last_name}} <i class="material-icons tiny">open_in_new</i></a></span>
            @endif

            @auth
                <a href="#!" data-type="photo" data-id='{{$photo->id}}' class="set-favorite secondary-content set-fav-photo"><i class="material-icons {{($star)?'orange-text':''}}">star</i></a>
            @else
                <a href="#modal-please-login"  class="modal-trigger secondary-content set-fav-photo"><i class="material-icons">star</i></a>
            @endauth
            <a href="{{$photo->image}}" class="big">
                <img src="{{$photo->thumb}}" alt="" title="{{$photo->title}}">
            </a>
        </div>

        <div class="card-content">

            @if(!empty($editable) and $editable == true)
                <a data-actionroute='{{route('photos.destroy', $photo->id)}}' class="modal-open-delete btn-floating halfway-fab waves-effect waves-light " ><i class="material-icons red">delete_forever</i></a>
                <span><a href="{{route('photos.edit', $photo->id)}}"><i class="material-icons ">edit</i></a></span>
                @include('inc.share-button', ['type'=>'icon', 'link'=>'#'])
                <i class="material-icons right card-title activator chip">expand_less</i>
            @else
                <a href="#" class="btn-floating halfway-fab waves-effect waves-light " ><i class="material-icons">share</i></a>
                <i class="material-icons right card-title activator chip">expand_less</i>
            @endif

                <p><i class="material-icons tiny orange-text">stars</i> {{($photo->stars->first())?$photo->stars->count():'-'}}</p>
                <p class="truncate">Date: {{$photo->created_at}}</p>

            @auth
                @if($photo->user->id == $user->id)
                    @if($photo->comments()->first())
                        @if(empty($read_comments))
                            <a href='{{route('comments.show', $photo->id)}}' class=" teal-text">Read comments @if($photo->hasNewComment()) <i class="material-icons tiny red-text">fiber_new</i> @endif</a>
                        @elseif($read_comments == 'inactive')
                            <a class=" grey-text">Read comments</a>
                        @endif
                    @else
                        <a  class="add-modal-comment grey-text">No comments</a>
                    @endif
                @else
                    <a href='#!' data-id="{{$photo->id}}" data-type="photo" class="add-modal-comment teal-text"><i class="material-icons tiny teal-text">create</i> Send comment</a>
                @endif
            @else
                <a href='#modal-please-login'  class="modal-trigger"><i class="material-icons tiny teal-text">create</i> Send comment</a>
            @endauth

        </div>

        <div class="card-reveal">
            <span class="card-title grey-text text-darken-4">{{$photo->title}}<i class="material-icons right">close</i></span>
            @if($photo->tags->first())
                <div class="divider"></div>
                <p>
                    @foreach($photo->tags as $tag)
                        <a class="chip" href="{{route('photos.index', ['tag'=>$tag->name])}}">{{$tag->name}}</a>
                    @endforeach
                </p>
            @endif
        </div>
    </div>
</div>

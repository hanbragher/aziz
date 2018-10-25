

<div class="card small">
    <div class="card-image waves-effect waves-block waves-light">
        <a href="{{$image->file}}" class="big">
            <img class="" src="{{$image->file}}" alt="" title="picture description">
        </a>
    </div>
    <div class="card-action">
        <span class="truncate">click to enlarge</span>
        {{--<span class="card-title activator grey-text text-darken-4 truncate"><i class="material-icons right">share</i></span>
--}}
    </div>





{{--//todo gallery nayel--}}


{{--<div class="card-content">
        <span class="card-title activator grey-text text-darken-4">Card Title<i class="material-icons right">more_vert</i></span>
    </div>
    <div class="card-reveal">
        <span class="card-title grey-text text-darken-4">Card Title<i class="material-icons right">close</i></span>
        <p>Here is some more information about this product that is only revealed once clicked on.</p>
    </div>--}}

</div>

{{--<a href="{{$image->file}}" class="big">
    <img src="{{$image->file}}" alt="" title="Image 1">
</a>--}}

@dd(\Intervention\Image\Facades\Image::make('/images/parallax2.jpg')->fit(200)->save('/images/1222.jpg'))
<a href="{{$image->file}}" class="big">
    <img class="" src="{{\Intervention\Image\Facades\Image::make('images/card.jpg')->fit(200)}}" alt="" title="picture description">
</a>
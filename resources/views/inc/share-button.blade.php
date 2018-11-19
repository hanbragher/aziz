@if($type == 'floating')
    <a href="{{$link}}" class="btn-floating halfway-fab waves-effect waves-light " ><i class="material-icons">share</i></a>
@elseif($type == 'icon')
    <span><a href="{{$link}}"><i class="material-icons padded-left">share</i></a></span>
@elseif($type == 'link')
    <a href="{{$link}}" >share</a>
@elseif($type == 'button')
    <a href="{{$link}}" class='btn'>Share<i class="material-icons right">share</i></a>
@endif

<div class="card">
    <div class="card-content">
        <p>I am a very simple card. I am good at containing small bits of information.
            I am convenient because I require little markup to use effectively.</p>
    </div>
    <div class="card-action">
    @if(!empty($editable) and $editable == true)
            <form action="#">
                <a href="{{route('adverts.edit', 1)}}" >Edit</a>
                <a onclick="return confirm('remove comment?')">Remove</a>
                <a href="{{route('adverts.edit', 1)}}" >show</a>

            </form>
    @else

        @endif

    </div>
</div>
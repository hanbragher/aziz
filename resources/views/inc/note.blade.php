<div class="card">
    <div class="card-content">
        <p>I am a very simple card. I am good at containing small bits of information.
            I am convenient because I require little markup to use effectively.</p>
    </div>
    @if(!empty($editable) and $editable == true)
        <div class="card-action">

            <form action="#">
                <a href="{{route('notes.edit', 1)}}" >Edit</a>
                <a onclick="return confirm('remove comment?')">Remove</a>
            </form>
        </div>
    @endif
</div>
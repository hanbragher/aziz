<div class="modal clear-list">
    <form action="/" method="post" id="clear_list_form">
        @method('DELETE')
        @csrf
        <div class="modal-content">
            <h4>Delete confirmation</h4>
            <p>Do you want to clear list?</p>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancel</a>
            <button class="btn red">Clear</button>
        </div>
    </form>
</div>
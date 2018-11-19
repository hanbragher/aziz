<div class="modal delete">
    <form action="/" method="post" id="delete_post_form" enctype="multipart/form-data">
        @method('DELETE')
        @csrf
        <div class="modal-content">
            <h4>Delete confirmation</h4>
            <p>Do you want to delete?</p>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancel</a>
            <button class="btn red">Delete</button>
        </div>
    </form>
</div>
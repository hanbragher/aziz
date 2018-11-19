$(document).ready(function(){
    var elems = document.getElementsByClassName('modal delete');
    var instance = M.Modal.init(elems[0]);
    $("a.modal-open-delete").click(function () {
        document.getElementById('delete_post_form').action = $(this).data("actionroute");
        instance.open()
    })
});
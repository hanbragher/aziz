$(document).ready(function(){
    var elems = document.getElementsByClassName('modal clear-list');
    var instance = M.Modal.init(elems[0]);
    $("button.modal-clear-list").click(function () {
        document.getElementById('clear_list_form').action = $(this).data("actionroute");
        instance.open()
    })
});
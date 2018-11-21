$(document).ready(function() {

    $('input#item-comment').characterCounter();

    var elems = document.getElementsByClassName('modal comment');
    var instance = M.Modal.init(elems[0]);
    $("a.add-modal-comment").click(function () {
        $("input#item-id").val($(this).data("id"));
        $("input#item-type").val($(this).data("type"));
        instance.open()
    });

    $("button.send-comment").click(function () {
        var itemid = $("input#item-id").val();
        var itemcomment = $("input#item-comment").val();
        var itemtype = $("input#item-type").val();
        $.ajax({
            method: 'POST',
            url: '/comments',
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data :{
                id: itemid,
                comment: itemcomment,
                type: itemtype
            },

            success: function(data){
                if(data.status === "success"){

                }
                $("input#item-comment").val(null);
                instance.close()
            },

            error: function(xhr, desc, err){
                console.log(err);
                instance.close()
            }
        });
    })

});
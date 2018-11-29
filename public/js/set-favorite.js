$(document).ready(function(){
    $("a.set-favorite").click(function () {
        var btn = $(this);
        $.ajax({
            method: 'POST',
            url: '/favorites',
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data :{
                "id":$(this).data("id"),
                "type":$(this).data("type")
            },
            success: function(data){
                console.log(data);
                if(data.status === "success"){
                    btn.find("i").toggleClass("orange-text");
                }
            },
            error: function(xhr, desc, err){
                console.log(err);
            }
        });
    })
});
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
                "id":$(this).data("announcementid"),
            },
            success: function(data){
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
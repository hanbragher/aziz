$('#form').submit(function(e){
    var tags = JSON.stringify(M.Chips.getInstance($('.chips')).chipsData).replace(/\s+/g,"_");
    $(this).append('<input type="hidden" name="tags" value='+tags+'>');
    return true;
});
/**
 * Created by rosl on 15.12.16.
 */


$('#save-orders').click(function(e){
    e.preventDefault();

    var items = [];

    $('.main-page .multiple-input-list__item').each(function(){
       var id = parseInt($(this).find('.list-cell__id p').text());
       var status = parseInt($(this).find('.list-cell__status select').val());
       var voucher = $(this).find('.list-cell__voucher input[type="text"]').val();
       items.push({
            id:id,
            status:status,
            voucher:voucher
        });
    });

    $.post('/admin/main/save-orders', {'items':items}, function(response){
        console.log(response);
        window.location.href = window.location.href;
    });

});


$('#save-referal-orders').click(function(e){
    e.preventDefault();

    var items = [];

    $('.main-page .multiple-input-list__item').each(function(){
        var id = parseInt($(this).find('.list-cell__id p').text());
        var status = parseInt($(this).find('.list-cell__status select').val());
        items.push({
            id:id,
            status:status
        });
    });

    $.post('/admin/main/save-referal-orders', {'items':items}, function(response){
        console.log(response);
        window.location.href = window.location.href;
    });


});
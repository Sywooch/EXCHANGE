$(document).ready(function(){
    $('.history-remove').click(function (e) {
        e.preventDefault();
        var that = $(this);
        $.post('/account/order-history', {id: $(this).data('id')}, function (response) {
            console.log(response, this);
            that.parents('.bid-item').remove();
        });
    })
});
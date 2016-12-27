$(document).ready(function(){
    $('.history-remove').click(function (e) {
        e.preventDefault();
        var that = $(this);
        $.post('/account/order-history', {id: $(this).data('id')}, function (response) {
            console.log(response, this);
            that.parents('.bid-item').remove();
        });
    })

    $('.i-pay').click(function (e) {
        e.preventDefault();
        $.post('/site/change-order-status', {
            id:$(this).data('id'),
            status:3,
        }, function(response){
            window.location.reload();
        })
    })
});
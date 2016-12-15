(function(){
    $('.order-form').submit(function(e){
        e.preventDefault();
        $(this).find('input').each(function(){
           if(!$(this).val()){
               return false;
           }
        });
        var data = $(this).serialize();
        var form = this;
        $.post($(this).attr('action'), data, function(response){
            console.log(response);
            $(form).find('.row input').val('');
            if(response){
                $('#total').text(response.info.sum+' '+response.info.currency+' '+response.info.valute+' по данным реквизитам: '+response.info.wallet);
                $('#totalBut').data('id', response.orderId);
                $('#tot_dialog').dialog('open');
            }
        });
    });

    $('#totalBut').click(function(e){
        e.preventDefault();
        $.post('site/change-order-status', {
            id:$(this).data('id'),
            status:3
        }, function(response){
            console.log(response);
            $('#tot_dialog').dialog('close');
        })
    });

    $('#register-form-email').change(function(e){
       var val = $(this).val();

       $('#register-form-username').val(val.split('@')[0])

        console.log(val);
    });

    $('.ajax-form').submit(function(e){
        e.preventDefault();
        var action = $(this).attr('action'),
            fields = $(this).serializeArray(),
            formData = new FormData();

        $(this).find('input[type="file"]').each(function(index){
            formData.append($(this).attr('name'), $(this)[0].files[0])
        });

        $.each(fields, function(index){
            formData.append(this.name, this.value);
        });

        var dialogs = [$("#question_dialog"),$("#comment_dialog"),$("#reg_dialog"),$("#reset_dialog"),$("#auth_dialog")];

        $.ajax({
            url: action,
            data: formData,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function(data){
                console.log(data);
                $.each(dialogs, function(){
                    $(this).dialog('close');
                })

            }
        });
    });

    $('.firms .firm').click(function(e){
       e.preventDefault();
       $(this).parents('.firms').find('input').hide();
        $(this).parents('.firms').find('span').show();
       $(this).find('span').hide();
        $(this).find('input').show();
    });
    $('.firms .firm input').change(function(e){
        $('.btn-save-firm').removeClass('hidden')
       $(this).parents('.firm').find('span').text($(this).val());
    });

    $("#tot_dialog").dialog({
        'autoOpen': false,
        'modal': true,
        'draggable': false,
        'resizable': false
    });

})($);
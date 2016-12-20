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
                if(response.voucher){
                    $('#voucher').removeClass('hidden');
                    $('#voucher_input').attr('placeholder', response.voucher);
                } else {
                    $('#voucher').addClass('hidden');
                    $('#voucher_input').val('');
                }
                $('#tot_dialog').dialog('open');
            }
        });
    });

    $('#totalBut').click(function(e){
        e.preventDefault();
        $('#tot_dialog').dialog('close');
        $('#success_modal').dialog('open');
        $.post('site/change-order-status', {
            id:$(this).data('id'),
            status:3,
            voucher: $('#voucher_input').val()
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

        $.each(dialogs, function(){
            $(this).dialog('close');
        });

        if($(this).attr('id') == 'registration-form') {
            $('#success_modal h5').text('Вы успешно зарегистрированы! Данные для входа отправлены на почту.')
            $('#success_modal').dialog('show');
        } else {
            $('#success_modal h5').text('Ваша заявка принята в обработку.')
        }

        $.ajax({
            url: action,
            data: formData,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function(data){
                console.log(data);


            },
            error: function(error){
                console.log(error);
            }
        });
    });



    $("#tot_dialog").dialog({
        'autoOpen': false,
        'modal': true,
        'draggable': false,
        'resizable': false
    });

    $('.ref-link:not(:first-child)').hide();

    $('.banner-type').click(function(e){
        e.preventDefault();

        var id = $(this).data('banner');

        $('.ref-link').hide();
        $('[data-banner-show="'+id+'"]').show();
    })

    new Clipboard('.copy');

    $('.stat-data .tab').click(function(e){
        e.preventDefault();
        var id = $(this).data('target-id');
        $(this).addClass('active').siblings().removeClass('active');
        $('#'+id).addClass('active').siblings().removeClass('active');
    })

    $('body').on('click','.btcross', function(e){
        e.preventDefault();
        if(!user){
            return false;
        }
        var name = $(this).prev().attr('name');
        if(name == 'email'){
            $(this).prev().val(user.email);
        }
        console.log(name);
        if(name.indexOf('orderField') === 0){
            var id = name.replace(/orderField/,'').replace('[','').replace(']', '');
            var field = user.fields.find(function(item){
               return item.field_id == id;
            }).wallet;

            $(this).prev().val(field);
        }
    })

})($);
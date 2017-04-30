//105 addClass, 128 removeClass

(function(){
    function openAlert(text){
        $('#alertModal .cont').text(text)
        $('#alertModal').dialog('open')
    }
    $('.order-form').submit(function(e){
        e.preventDefault();
        var data = $(this).data();
        var input = $('#from_value_input').val();
        var output = $('#to_value_input').val();

        var comision_count = parseInt(input) * data.comission / 100;
        if(comision_count.toFixed(4) < data.comission.toFixed(4)){
            comision_count = data.comission;
            var priceOut = parseInt(input)+comision_count;
            $('#from_value_input').val(priceOut);
        }

        if(parseInt(input) < data.min || parseInt(input) > data.max){
            $('#alertModal').find('.ah-content.cont').text('Недопустимое значение для обмена. Минимальное значение: '+data.min+', максимальное: '+data.max);
            $('#alertModal').removeClass('ah-hidden');            
            //openAlert('Недопустимое значение для обмена. Минимальное значение: '+data.min+', максимальное: '+data.max);
            return false;
        }

        $(this).find('input').each(function(){
           if(!$(this).val()){
               return false;
           }
        });

        var data = $(this).serialize();
        console.log(data);
        var form = this;
        $.post($(this).attr('action'), data, function(response){
            console.log(response);
            $(form).find('input').val('');
            if(response){
                $('#total').html(response.info);
                $('#totalBut').data('id', response.orderId);
                if(response.voucher){
                    $('#voucher').removeClass('ah-hidden');
                    $('#voucher_input').attr('placeholder', response.voucher);
                } else {
                    $('#voucher').addClass('ah-hidden');
                    $('#voucher_input').val('');
                }

                if(response.cash){
                    $('#cash').removeClass('ah-hidden');
                } else {
                    $('#cash').addClass('ah-hidden');
                    $('#cash').val('');
                }

                $('#tot_dialog').removeClass('ah-hidden');

                $('#cash select').data('dd').destroy();
                $('#cash select').msDropDown();
            }
        }).error(function(response) { /*alert("Ошибка выполнения");*/ console.log(response); });
    });

    $('body').on('click', '#closeTotDialog', function(){
        //$('#tot_dialog').dialog('close');
        $('#tot_dialog').addClass('ah-hidden');
    });

    $('body').on('click', '#totalBut',function(e){
        e.preventDefault();
        $('#tot_dialog').hide();
        $('#success_modal').show();

        setTimeout(function(){
            $('#success_modal').hide();
        }, 1000)

        $.post('/site/change-order-status', {
            id:$(this).data('id'),
            status:3,
            voucher: $('#voucher_input').val(),
            cash: $('#cash select').val()
        }, function(response){
            console.log(response);
            $('#tot_dialog').hide();
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
            //$(this).dialog('close');
            $(this).addClass('ah-hidden');
        });

        if($(this).attr('id') == 'registration-form') {
            error = 0;
            $(this).find('input[type="text"]').each( function(){
              if(!$(this).val()){                
                error = 1;
              }
            });
            if(error){
              alert('Заполните все поля!');
              return false;
            }

            $.ajax({
                url: action,
                data: formData,
                processData: false,
                contentType: false,
                type: 'POST',
                success: function(data){
                    console.log('data: '+data);
                    $('#login-form button').text('Войти')
                    if(data == 'testimonial'){
                        window.location.href = window.location.href;
                    }

                    if(data.error){
                        alert('Введите корректные данные')

                        $("#reg_dialog").removeClass('ah-hidden');

                        return false;
                    }

                    $('#success_modal h5').text('Вы успешно зарегистрированы! Данные для входа отправлены на почту.')
                    //$('#success_modal').dialog('open');
                    $('#success_modal').removeClass('ah-hidden');
                },
                error: function(error){
                    console.log('error: '+error);
                }
            });

            return true;
        } else {
            $('#success_modal h5').text('Ваша заявка принята в обработку.')
        }

        if($(this).attr('id') == 'login-form'){
            $('#login-form button').text('Подождите...')
        } else {
            $('#login-form button').text('Войти')
        }

        $.ajax({
            url: action,
            data: formData,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function(data){
                console.log('data: '+data);
                $('#login-form button').text('Войти')
                if(data == 'testimonial'){
                    window.location.href = window.location.href;
                }
            },
            error: function(error){
                console.log('error: '+error);
            }
        });
    });



    /*$("#tot_dialog").dialog({
        'autoOpen': false,
        'modal': true,
        'draggable': false,
        'resizable': false,
        'closeText': ''
    });*/

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
    });

})($);
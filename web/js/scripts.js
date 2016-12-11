(function(){
    $('[data-id-caption]').hover(function(){
        var elem = this;

        $('#cur_from').val($(elem).data('id-caption')).data('dd').refresh();

        $(this).addClass('active').siblings().removeClass('active');
        var id = $(elem).data('id-caption');
        $('[data-id]').addClass('hidden');
        $('[data-id='+id+']').removeClass('hidden');
    });

    $('.col-2 .row').hover(function(e){
        var index = $(this).index();
        e.preventDefault();
        $(this).addClass('active').siblings().removeClass('active');
        $('.col-3[data-id="'+$(this).parents('.col-2').data('id')+'"] .row:eq('+index+')').addClass('active').siblings().removeClass('active');
        $('#cur_to').val($(this).data('child-id')).data('dd').refresh();

        $('#form_course').text($(this).data('course'))
    });

    $('.col-3 .row').hover(function(e){
        var index = $(this).index();
        e.preventDefault();
        $(this).addClass('active').siblings().removeClass('active');
        var elem = $('.col-2[data-id="'+$(this).parents('.col-3').data('id')+'"] .row:eq('+index+')');
        elem.addClass('active').siblings().removeClass('active');
        $('#cur_to').val($(elem).data('child-id')).data('dd').refresh();

        $('#form_course').text($(elem).data('course'))
    });

    $('.order-form').submit(function(e){
        e.preventDefault();
        var data = $(this).serialize();
        var form = this;
        $.post($(this).attr('action'), data, function(response){
            console.log(response);
            $(form).find('input:not([type="hidden"])').val('');
            alert('Ваша заявка принята в обработку!');
        });
    });

    $('#from_value_input').keyup(function(e){
        var course = parseFloat($('#form_course').text());
        $('#to_value_input').val($(this).val()*course);
    });
    $('#to_value_input').keyup(function(e){
        var course = parseFloat($('#form_course').text());
        $('#from_value_input').val($(this).val()*(1/course));
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
    })

})($);
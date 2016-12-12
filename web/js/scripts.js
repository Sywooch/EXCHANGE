(function(){
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
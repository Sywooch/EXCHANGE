$(document).ready(function() {
	$(".mob-control button").click(function() {
		$('.menu').css('top', 0);
	});
	$(".menu .close").click(function() {
		$('.menu').css('top', '-100%');
	});
	$(".scrollbar").scrollbar();
	
	$("#tosecond").on("click", function (event) {
        //отменяем стандартную обработку нажатия по ссылке
        event.preventDefault();
        //забираем идентификатор бока с атрибута href
        var id  = $(this).attr('href'),
        //узнаем высоту от начала страницы до блока на который ссылается якорь
        top = $(id).offset().top;
        //анимируем переход на расстояние - top за 850 мс
        $('body,html').animate({scrollTop: top}, 850);
    });
	
	$('#firms-form > div.container > div.col').on('click', 'div.payway', function(){
		$('#shadow').show();
		$('#firms-form div.form-group').show();
	});
	$('#firms-form div.form-group > img.close').on('click', function(){
		$('#shadow').hide();
		$('#firms-form div.form-group').hide();
	});
	
	//#firms-form > div > div.col > div:nth-child(3)
});

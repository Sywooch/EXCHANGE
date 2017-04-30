$(document).ready(function() {
	$(".mob-control button").click(function() {
		$('.menu').css('top', 0);
	});
	$(".menu .close").click(function() {
		$('.menu').css('top', '-100%');
	});
	setTimeout(function(){$(".scrollbar").scrollbar();},7000);
	
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
	
	
	$('#firms-form > div.currencies-list > div.ah-group').on('click', 'div.payway', function(){
		$(this).next('div.form-group').removeClass('ah-hidden');
	});
	
	$('#cur_to, #cur_from').on('click', function(){
		//console.log('test');
		$(this).find('.ps-list').slideToggle();
	});
	$('#cur_to').on('click', '.ps-list > div' ,function(){
		var tags = $(this).html();
		$('#cur_to > .ps-content').html(tags);
		$(this).parent('.ps-select').slideToggle();
	});
	$('#cur_from').on('click', '.ps-list > div' ,function(){
		var tags = $(this).html();
		$('#cur_from > .ps-content').html(tags);
		$(this).parent('.ps-select').slideToggle();
	});
	
	/*$('#firms-form > div.container > div.col').on('click', 'div.payway', function(){
		$('#shadow').show();
		$(this).next('div.form-group').show();
	});
	$('#firms-form div.form-group > img.close').on('click', function(){
		$('#shadow').hide();
		$('#firms-form div.form-group').hide();
	});*/
});

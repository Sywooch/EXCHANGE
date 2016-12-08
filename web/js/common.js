$(document).ready(function() {
	$(".mob-control button").click(function() {
		$('.menu').css('top', 0);
	});
	$(".menu .close").click(function() {
		$('.menu').css('top', '-100%');
	});
	$(".scrollbar").scrollbar();
});
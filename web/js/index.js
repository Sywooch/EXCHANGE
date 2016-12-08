$(document).ready(function() {
	$("select").msDropDown();
	$('input[type="checkbox"]').iCheck({checkboxClass: 'icheckbox_minimal'});	
	$('.owl-carousel').owlCarousel({
		loop: true,
		items: 1,
		nav: true,
		navText: ['','']
	});
});
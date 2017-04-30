$(document).ready(function() {
	setInterval(function(){
		$("select").msDropDown();
	},7000);
	
		
	
	//$('input[type="checkbox"]').iCheck({checkboxClass: 'icheckbox_minimal'});	
	$('.owl-carousel').owlCarousel({
		loop: true,
		items: 1,
		nav: true,
		navText: ['','']
	});

});
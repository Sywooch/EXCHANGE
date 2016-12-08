$(document).ready(function() {
	$(".stat-data .tab").click(function() {
		if (!$(this).hasClass('active')) {
			$(".stat-data .tab").removeClass('active');
			$(this).addClass('active');
			$(".stat-data .tab-content").removeClass('active');
			$('#' + $(this).attr('data-target-id')).addClass('active');
		}
	});
	$("select").msDropDown();
});
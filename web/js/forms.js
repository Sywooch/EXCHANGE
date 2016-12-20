$( function() {
	$("select").msDropDown();
	$('input[type="checkbox"]').iCheck({checkboxClass: 'icheckbox_minimal'});	
	
	$("#question_dialog").dialog({
		'autoOpen': false,
		'modal': true,
		'draggable': false,
		'resizable': false,
		'closeText': ''
	});

    $("#success_modal").dialog({
        'autoOpen': false,
        'modal': true,
        'draggable': false,
        'resizable': false,
		'closeText': ''
    });


    $("#comment_dialog").dialog({
		'autoOpen': false,
		'modal': true,
		'draggable': false,
		'resizable': false,
		'closeText': ''
	});
	
	$("#reg_dialog").dialog({
		'autoOpen': false,
		'modal': true,
		'draggable': false,
		'resizable': false,
		'closeText': ''
	});
	
	$("#reset_dialog").dialog({
		'autoOpen': false,
		'modal': true,
		'draggable': false,
		'resizable': false,
		'closeText': ''
	});
	
	$("#auth_dialog").dialog({
		'autoOpen': false,
		'modal': true,
		'draggable': false,
		'resizable': false,
		'closeText': ''
	});
	
	$('#question_dialog_btn').click(function(e){
		e.preventDefault();
		$("#question_dialog").dialog('open');
	});
	
	$('#comment_dialog_btn').click(function(e){
		e.preventDefault();
		$("#comment_dialog").dialog('open');
	});
	
	$('#reg_dialog_btn').click(function(e){
		e.preventDefault();
		$("#reg_dialog").dialog('open');
	});
	
	$('#reset_dialog_btn').click(function(e){
		e.preventDefault();
		$("#reset_dialog").dialog('open');
	});
	
	$('#auth_dialog_btn').click(function(e){
		e.preventDefault();
		$("#auth_dialog").dialog('open');
	});
});
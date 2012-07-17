$(function(){
	$('.date').live('click', function(){
		$(this).datetimepicker({
			dateFormat: 'dd-mm-yy',
			showOn: 'focus'
		}).focus();
	});
});

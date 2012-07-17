$(function() {
	$( "#user_autocomplete" ).autocomplete({
		source: function(request, response) {
			$.ajax({
				url: config.base_url + 'autocomplete',
				data: {
					username: $("#user_autocomplete").val(),
					csrf_test_name: $('input[name=csrf_test_name]').val()
				},
				dataType: 'json',
				type: 'POST',
				success: function(data){
					response(data);
				}
			});
		},
		minLength: 2
	});

	if (window.location.hash != 'undefined' && window.location.hash != '') {
		$('#user_autocomplete').val(window.location.hash.substring(1));
	}
});
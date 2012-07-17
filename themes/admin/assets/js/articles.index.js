$(function(){
	$('select').change(function(){
		var e = $(this);
		var url = location.href.split('/');
		for(var i = 0; i < url.length; i++) {
			if(url[i] == e.attr('name')) {
				url[i+1] = e.val();
				location.href = url.join('/');
				return;
			}
		}
		location.href = location.href + '/' + e.attr('name') + '/' + e.val();
	});
});

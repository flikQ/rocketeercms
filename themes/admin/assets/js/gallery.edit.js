$(function(){
	$('.preview-actions a').click(function(e){
		e.preventDefault();
		e = $(this);
		$.ajax({
			type : 'GET',
			url: e.attr('href'),
			complete : function(){
				switch(e.attr('id')) {
					case 'make_cover':
						alert('This photo is now a cover of gallery');
						break;
					case 'remove':	
						e.parent().parent().remove();
						break;
					default:
						alert('unknown action');
				}
			}
		});
	});
});

String.prototype.trim = function() { // not inflector, just helper for its libraries
	return this.replace(/^\s\s*/, '').replace(/\s\s*$/, '');
}

String.prototype.transform = function() {
	return this.trim().toLowerCase().replace(/[\s]+/g, '-').replace(/(\?|\!|\,)/, '');
}

$(function(){
	var url_title = $('input[name="url_title"]');
	$('input[name="title"]').keyup(function(){
		url_title.val($(this).val().transform());
	});
});

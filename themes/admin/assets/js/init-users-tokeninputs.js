function pop(members) {
	members = JSON.parse(members);
	for(var i = 0; i < members.length; i++) {
		$.TokenList.insert_token(members[i].id, members[i].name);
	}
}
$(function(){
	$('.users-tokeninput').tokenInput('/admin/users/autocomplete/', {
		hintText : 'Start typing user\'s name',
		method : 'GET'
	});
	/*if(val) {
		var members = JSON.parse(e.val());
		for(var i = 0; i < members.length; i++) {
			$.TokenList.insert_token(members[i].id, members[i].name);
		}
		e.remove();
	}*/
});

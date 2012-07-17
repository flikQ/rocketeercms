$(function(){
	$('#add-sp-item').click(function(e){
		e.preventDefault();
		$(this).next().after('<div class="form-row">' +
			'<label>Headline</label>' +
			'<input type="text" name="items[][headline]"><br>' +
			'<label>Description</label><textarea name="items[][description]"></textarea><br>' +
			'<label>URL</label><input type="text" name="items[][url]"><br>' +
			'<label>Image</label><input type="file" accept="image/*" name="items[][image]"><br>' +
			'</div>'
		);
	});
});

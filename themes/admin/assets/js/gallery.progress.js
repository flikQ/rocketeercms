$(function(){
	var preload_img = $('<img src="/assets/admin/img/loading.gif" alt="" />').appendTo('html');
	preload_img.hide();
	$('input[type=submit]').click(function(e){
		$('html').append('<div class="pagefade" style="height:' + $(document).height() + 'px;">' +
						'<div class="progress-box" style="left:' + parseInt(($(document).width() - 400) /2) + 'px;' +
						'top:' + ($('body').scrollTop() + parseInt($(window).height() / 2.5)) + 'px;">' +
						'<b>Please wait, while your files are uploading.</b>' + 
						'<p>(if you selected too many files, it may take a while)</p>' +
						'<img src="/assets/admin/img/loading.gif" alt="" /></div></div>');
	});
});

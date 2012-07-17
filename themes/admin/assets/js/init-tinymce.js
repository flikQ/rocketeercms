$(function(){
	var full = $('textarea.full');
	if(full.length > 0) {
		full.tinymce({
			height: 500,
			skin : 'wp_theme',
			script_url : '/themes/admin/assets/js/tiny_mce/tiny_mce.js',
			theme : 'advanced',
			theme_advanced_toolbar_location : 'top',
			theme_advanced_toolbar_align : 'left',
			plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist",
			theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|, |,justifyleft,justifycenter,justifyright,justifyfull,|,link,unlink,anchor,image,|,formatselect,|,forecolor,backcolor",
			theme_advanced_buttons2 : ",|,cut,copy,paste,|,bullist,numlist,|,outdent,indent,blockquote,|,charmap,iespell,media,|,code",
			theme_advanced_buttons3 : "tablecontrols",
			theme_advanced_statusbar_location : "bottom",
			
			file_browser_callback : "tinyBrowser",
            
            
            setup: function(ed){
                ed.onInit.add(function(ed) {
                  ed.pasteAsPlainText = true;
                });
                ed.onPaste.add(function(ed) {
                  ed.pasteAsPlainText = true;
                });
            },
            
            
			theme_advanced_resizing : true,
			//content_css : "css/content.css",
			template_external_list_url : "lists/template_list.js",
			external_link_list_url : "lists/link_list.js",
			external_image_list_url : "lists/image_list.js",
			media_external_list_url : "lists/media_list.js"
		});
	}
	var short = $('textarea.short');
	if(short.length > 0) {
		short.tinymce({
			height: 150,
			script_url : '/themes/admin/assets/js/tiny_mce/tiny_mce.js',
			theme : 'advanced',
			skin : 'wp_theme',
			theme_advanced_toolbar_location : 'top',
			theme_advanced_toolbar_align : 'left',
			theme_advanced_resizing : true,
			plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist",
            theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,link,unlink,anchor,image,|,bullist,numlist,|,code",
			theme_advanced_buttons2 : "",
			theme_advanced_buttons3 : "",
			theme_advanced_statusbar_location : "bottom",
			
			file_browser_callback : "tinyBrowser",

            setup: function(ed){
                ed.onInit.add(function(ed) {
                  ed.pasteAsPlainText = true;
                });
                ed.onPaste.add(function(ed) {
                  ed.pasteAsPlainText = true;
                });
            },
					});
	}
});

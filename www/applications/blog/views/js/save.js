function saveDraft() {		
	var title 	  	 = $('#title').val();
	var tags 	  	 = $('#tags').val();
	var editor    	 = $('#editor').val();
	var code      	 = $('#code').val();
	var buffer    	 = $('#buffer').val();
	var pwd       	 = $('#pwd').val();	
	var postID	  	 = $('#ID_Post').val();
	var language  	 = $('#language').val();
	var situation 	 = $('#situation').val();
	var temp_title   = $('#temp_title').val();
	var temp_tags    = $('#temp_tags').val();
	var temp_content = $('#temp_content').val();

	if(editor == 1) {
		var content = $('#redactor').getCode();
	} else {
		var content = $('#redactor').val();
	}

	if(title.length > 5 && content.length > 30 && (content != temp_content || title != temp_title || tags != temp_tags)) {
		$.ajax({
			type: 'POST',
			url:   PATH + '/blog/cpanel/draft',
			data: 'title=' + title + '&content=' + content + '&tags=' + tags + '&language=' + language + '&buffer=' + buffer + '&code=' + code + '&postID=' + postID + '&situation=' + situation,
			success: function(response) {
				$('#alert-message').show();
				$('#alert-message').removeClass('no-display');
				$('#alert-message').html(response);
				$('#alert-message').fadeOut(10000);
				$('#temp_title').val(title);
				$('#temp_tags').val(tags);
				$('#temp_content').val(content);
			}
		});
	}		
}

setInterval(function() {
    saveDraft();
}, 500000);
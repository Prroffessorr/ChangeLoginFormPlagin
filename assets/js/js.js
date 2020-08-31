jQuery(document).ready(function() {
	var uploadID = ''; /*setup the var*/
	jQuery('.upimg').click(function() {
		uploadID = jQuery(this).prev('input'); /*grab the specific input*/
		var formfield = jQuery('.upload').attr('name');
		tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
		return false;
	});

	window.send_to_editor = function(html) {
		var imgurl = jQuery('img',html).attr('src');
		uploadID.val(imgurl); 
		/*assign the value to the input*/
		tb_remove();
        jQuery("#logo-img-prv").attr("src",imgurl).show();
	};
});

// jQuery(function($){
// 	/*
// 	 * действие при нажатии на кнопку загрузки изображения
// 	 * вы также можете привязать это действие к клику по самому изображению
// 	 */
// 	$('.upload_image_button').click(function(){
// 		var send_attachment_bkp = wp.media.editor.send.attachment;
// 		var button = $(this);
// 		wp.media.editor.send.attachment = function(props, attachment) {
// 			$(button).parent().prev().attr('src', attachment.url);
// 			$(button).prev().val(attachment.id);
// 			wp.media.editor.send.attachment = send_attachment_bkp;
// 		}
// 		wp.media.editor.open(button);
// 		return false;    
// 	});
// 	/*
// 	 * удаляем значение произвольного поля
// 	 * если быть точным, то мы просто удаляем value у input type="hidden"
// 	 */
// 	$('.remove_image_button').click(function(){
// 		var r = confirm("Уверены?");
// 		if (r == true) {
// 			var src = $(this).parent().prev().attr('data-src');
// 			$(this).parent().prev().attr('src', src);
// 			$(this).prev().prev().val('');
// 		}
// 		return false;
// 	});
// });


// jQuery(document).ready(function($){
// 	var custom_uploader;
// 	$('#upload_image_button').click(function(e) {
// 	  e.preventDefault();
// 	  //If the uploader object has already been created, reopen the dialog
// 	  if (custom_uploader) {
// 		custom_uploader.open();
// 		return;
// 	  }
// 	  //Extend the wp.media object
// 	  custom_uploader = wp.media.frames.file_frame = wp.media({
// 		title: 'Choose Image',
// 		button: {
// 		  text: 'Choose Image'
// 		},
// 		multiple: true
// 	  });
// 	  custom_uploader.on('select', function() {
// 		var selection = custom_uploader.state().get('selection');
// 		selection.map( function( attachment ) {
// 		  attachment = attachment.toJSON();
// 		  $("#obal").after("<img src=" +attachment.url+">");
// 		});
// 	  });
// 	  custom_uploader.open();
// 	});
//   });
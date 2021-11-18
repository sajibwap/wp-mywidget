(function($){
	"use strict";
	$(document).ready(function(){
		
		$("body").off("click",".imguploader");
		$("body").on("click",".imguploader", function(){

			var that = this;

			var mediaUploader = wp.media.frames.file_frame = wp.media({
				frame:'post',
				state:'insert',
				multiple:true
			})

			mediaUploader.on('insert',function(){
				var data = mediaUploader.state().get('selection');
				var json_data = data.toJSON();
				var selected_ids = _.pluck(json_data,'id');
				var img_container = $(that).parent().siblings('.img-preview');

				if (selected_ids.length > 0) {
					$(that).css('margin','2px');
					$(that).val('Change Image');
				}

				img_container.html("");

				$(that).parent().prev('input').val(selected_ids.join(","));
				$(that).parent().prev('input').trigger('change')

				data.map(function(img){
					if (img.attributes.subtype == 'png' || img.attributes.subtype == 'jpg' || img.attributes.subtype == 'jpeg' ) {
						try{
							img_container.append(`<img src="${img.attributes.sizes.thumbnail.url}">`);
						}catch(e){

						}

					}
				})

				mediaUploader.on("open", function(){
					var selection = mediaUploader.state().get('selection');
					var selected_ids = $(that).parent().prev('input').val().split(",");
					$(that).parent().prev('input').trigger('change');

					for (var i = 0; i < selected_ids.length; i++) {
						if (selected_ids[i] > 0) {
							selection.add(wp.media.attachment(selected_ids[i]));
						}
					}
				})
			})

			mediaUploader.open();
			return false;

		});



	})
}(jQuery));
(function($){
	"use strict";
	$(document).ready(function(){
		
		$("body").off("click",".imguploader");
		$("body").on("click",".imguploader", function(){
			var media;
			var that = this;

			if (media) {
				media.open();
				return; // Prevent opening object each time click on button
			}
 
			media = wp.media({
				title: "Select an image",
				button: {
					text: "Upload"
				},
				multiple:false
			});

			media.on("select",function(){
				var attachment = media.state().get('selection').first().toJSON();
				$(".img-id").val(attachment.id);
				$(".img-preview").html(`<img src="${attachment.sizes.thumbnail.url}">`);
			})

			media.on("open", function(){
				//var selection = media.state().get('selection');
				var selected_id = $(that).parent().prev('input').val();
				media.state().get('selection').add(wp.media.attachment(selected_id));

				$(that).parent().prev('input').trigger('change');
			})


			media.open();
			return false;

		});




	})
}(jQuery));
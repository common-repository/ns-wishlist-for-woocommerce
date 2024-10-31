jQuery(document).ready(function($) {
	
	$("#ns-close-modal").click(function() {
		$("#TB_overlay").show();
		$("#TB_window").show();
		$(".ns-modal-wishlist-layer").hide();
		$(".ns-modal-wishlist").hide();
		$("html").removeClass("ns-modal-opened");
		
		
	});

	$(".ns-div-open-modal").click(function() {
		$("#TB_overlay").hide();
		$("#TB_window").hide();
		$(".ns-div-success").hide();
		$(".ns-modal-wishlist-layer").show();
		$(".ns-modal-wishlist").show();
		$(".ns-textarea-size").show();
		$(".ns-div-share-now").show();
		$(".ns-div-success").hide();
		$(".ns-div-error").hide();
		$("html").addClass("ns-modal-opened");
		
	});

	$("#ns-share-now").click(function() {

		var ns_mail_send_to = $('.ns-textarea-dialog').val();
		var ns_mail_sender_name = $('#ns-your-name').val();

		$.ajax({
			url: nsdialogwish.ajax_url, 
			type : 'POST',
			data : {
				action : 'ns_send_mail',
				ns_mail_send_to : ns_mail_send_to,
				ns_mail_sender_name : ns_mail_sender_name
			},
			success: function(result){
				$(".ns-textarea-size").hide();
				$(".ns-div-share-now").hide();
				if(result == "done")
					$(".ns-div-success").show();
				else
					$(".ns-div-error").show();
				
			}
		});
		
	});
	
	$(".ns-try-again").click(function() {

		$(".ns-div-error").hide();
		$(".ns-textarea-size").show();
		$(".ns-div-share-now").show();
		
	});
		
});


  
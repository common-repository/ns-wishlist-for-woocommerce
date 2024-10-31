
jQuery( document ).ready(function($) {
  // Handler for .ready() called.

/* *** add to wishlist *** */
jQuery('.nswishlistclass').click(function($) {
	var nsadd_wish = jQuery(this).data('id');
	//if (nsadd_wish!=-1) {
		jQuery('#nswload'+nsadd_wish).removeClass( "viewIconNsLoader" );
		jQuery('#nswheart'+nsadd_wish).addClass( "viewIconNsLoader" );
		
		jQuery.ajax({
			url : nsaddtowish.ajax_url,
			type : 'post',
			data : {
				action : 'ns_addtowish',
				nsadd_wish : nsadd_wish
			},
			success : function( response ) {
				//var wish = jQuery('#ns_my_wishlist').html();
				jQuery('#ns_my_wishlist').append(response);
				var str = response;
				var res = str.replace("id=\"rem", "id=\"remwid");
				jQuery('#ns_my_wishlist_widget').append(res);
				jQuery('#nswload'+nsadd_wish).addClass( "viewIconNsLoader" );
				jQuery('#nswheart'+nsadd_wish).removeClass( "viewIconNsLoader" );
				jQuery('.NsEmptytoHide').hide();
				jQuery('#nsw'+nsadd_wish).addClass( "ns-add-to-wishlist-color" );
				jQuery('.ns-div-share-on-wishlist').show();
				//jQuery('.ns-add-to-wishlist-color').css({color: "red"});
				/*
				if (wish.search(response) == -1){
					if (wish == ''){
						jQuery('#ns_my_wishlist').append(response);
					}else{
						jQuery('#ns_my_wishlist').append(','+response);
					}
				}
				*/
			}
		});
	//}
})

/* *** remove to wishlist PAGE AND PAGE RELOAD *** */
jQuery('.removewishclass').click(function($) {
//jQuery('#ns_my_wishlist').on("click","div",function(){
	var nsremove_wish = jQuery(this).data('id');
	if (nsremove_wish != undefined){
		//alert(nsremove_wish);
		jQuery.ajax({
			url : nsremovetowish.ajax_url,
			type : 'post',
			data : {
				action : 'ns_removetowish',
				nsremove_wish : nsremove_wish
			},
			success : function( response ) {
				var result = JSON.parse( response);
				if(result[0]=="is_last")
					jQuery('.ns-div-share-on-wishlist').hide();
				//alert (response);
				jQuery('.rem'+result[1]).remove();
				jQuery('#remwid'+result[1]).remove();
				
				//jQuery('#ns_my_wishlist').append(response);
				/*
				if (wish.search(response) == -1){
					if (wish == ''){
						jQuery('#ns_my_wishlist').append(response);
					}else{
						jQuery('#ns_my_wishlist').append(','+response);
					}
				}
				*/
			}
		});
	} // if undefined	
})



/* *** remove to wishlist MODAL *** */
//jQuery('.removewishclass').click(function($) {
jQuery('#ns_my_wishlist').on("click","div",function(){
	var nsremove_wish = jQuery(this).data('id');
	if (nsremove_wish != undefined){
		//alert(nsremove_wish);
		jQuery.ajax({
			url : nsremovetowish.ajax_url,
			type : 'post',
			data : {
				action : 'ns_removetowish',
				nsremove_wish : nsremove_wish
			},
			success : function( response ) {

				var result = JSON.parse( response);
				if(result[0]=="is_last")
					jQuery('.ns-div-share-on-wishlist').hide();
				//alert (response);
				jQuery('.rem'+result[1]).remove();
				jQuery('#remwid'+result[1]).remove();
				//alert (response);
				jQuery('#nsw'+nsremove_wish).removeClass( "ns-add-to-wishlist-color" );
				//jQuery('#ns_my_wishlist').append(response);
				/*
				if (wish.search(response) == -1){
					if (wish == ''){
						jQuery('#ns_my_wishlist').append(response);
					}else{
						jQuery('#ns_my_wishlist').append(','+response);
					}
				}
				*/
			}
		});
	} // if undefined	
})



/* *** remove to wishlist WIDGET *** */
//jQuery('.removewishclass').click(function($) {
jQuery('#ns_my_wishlist_widget').on("click","div",function(){
	var nsremove_wish = jQuery(this).data('id');
	if (nsremove_wish != undefined){
		//alert(nsremove_wish);
		jQuery.ajax({
			url : nsremovetowish.ajax_url,
			type : 'post',
			data : {
				action : 'ns_removetowish',
				nsremove_wish : nsremove_wish
			},
			success : function( response ) {
				//alert (response);
				var result = JSON.parse(response);
				//alert (response);
				if(result[0]=="is_last")
					jQuery('.ns-div-share-on-wishlist').hide();
				jQuery('.rem'+result[1]).remove();
				jQuery('#remwid'+result[1]).remove();
				jQuery('#nsw'+nsremove_wish).removeClass( "ns-add-to-wishlist-color" );
				//jQuery('#ns_my_wishlist').append(response);
				/*
				if (wish.search(response) == -1){
					if (wish == ''){
						jQuery('#ns_my_wishlist').append(response);
					}else{
						jQuery('#ns_my_wishlist').append(','+response);
					}
				}
				*/
			}
		});
	} // if undefined	
})


});
<?php
add_action( 'woocommerce_after_shop_loop_item', 'ns_ww4w_function_loop', 10);

function ns_ww4w_function_loop(){


	global $post;

	//checking if product is in wishlist
	$ns_color='';
	// if(is_user_logged_in()){
    //     $ns_saved_wishlist = get_user_meta(get_current_user_id(), "ns_user_wishlist", true); //prendo l'usermeta dal db
    //     if($ns_saved_wishlist != '')
	// 		if(in_array($post->ID, $ns_saved_wishlist))
	// 			$ns_color=' ns-add-to-wishlist-color';
    // }else if(isset($_COOKIE["ns_nsww_cookie"])){
	// 	if (preg_match('/\b'.$post->ID.'\b/',$_COOKIE["ns_nsww_cookie"]))
	// 		$ns_color=' ns-add-to-wishlist-color';
	// }
	if(ns_print_differnt_button_if_is_in_wishlist($post->ID))
		$ns_color=' ns-add-to-wishlist-color';


	$nsaddtowish = '
		<div id="nsw'.$post->ID.'" data-id="'.$post->ID.'" class="nswishlistclass nswLoopProduct'.$ns_color.'">
			<div class="viewIconNsLoader" id="nswload'.$post->ID.'">
				'.get_option('ns_wishlist_font_awesome_post', '<i class="fas fa-heartbeat"></i>').'
				<span class="vNSalign">'.get_option('ns_whislist_label', 'Add to wishlist').'</span>
			</div>
			<div id="nswheart'.$post->ID.'">
				<span class="vNSalign">'.get_option('ns_wishlist_font_awesome_pre', '<i class="fas fa-heart"></i>').'</span>
				<span class="vNSalign">'.get_option('ns_whislist_label', 'Add to wishlist').'</span>
			</div>
		</div>
		<br>';
    	
    echo $nsaddtowish;




}
?>

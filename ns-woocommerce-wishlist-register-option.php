<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function ns_wishlist_activate_set_options()
{
    add_option('ns_whislist_label', '');
    add_option('ns_whislist_modal_link', '');
    add_option('ns-wishlist-page', '');
    add_option('ns_wishlist_font_awesome_pre', '<i class="fas fa-heart"></i>');
    add_option('ns_wishlist_font_awesome_post', '<i class="fas fa-heartbeat"></i>');
}

register_activation_hook( __FILE__, 'ns_wishlist_activate_set_options');



function ns_wishlist_register_options_group()
{
    register_setting('ns_wishlist_options_group', 'ns_whislist_label');
    register_setting('ns_wishlist_options_group', 'ns_whislist_modal_link');   
    register_setting('ns_wishlist_options_group', 'ns-wishlist-page');
    register_setting('ns_wishlist_options_group', 'ns_wishlist_font_awesome_pre');
    register_setting('ns_wishlist_options_group', 'ns_wishlist_font_awesome_post');
}
 
add_action ('admin_init', 'ns_wishlist_register_options_group');

?>
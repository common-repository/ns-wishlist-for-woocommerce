<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* *** add menu page and add sub menu page *** */
add_action( 'admin_menu', function()  {
    add_menu_page( 'Wishlist', 'Wishlist', 'manage_options', untrailingslashit( dirname( __FILE__ ) ).'/ns_admin_option_dashboard.php', '', plugin_dir_url( __FILE__ ).'img/backend-sidebar-icon.png', 60);
	add_submenu_page(untrailingslashit( dirname( __FILE__ ) ).'/ns_admin_option_dashboard.php', 'How to install premium version', 'How to install premium version', 'manage_options', 'how-to-install-premium-version', function(){  wp_redirect('http://www.nsthemes.com/how-to-install-the-premium-version/'); exit; });
});

/* *** add style *** */
add_action( 'admin_enqueue_scripts', function() {
	wp_enqueue_style('ns-option-css-page-wish', plugin_dir_url( __FILE__ ) . 'css/ns-option-css-page-wish.css');
	wp_enqueue_style('ns-option-css-custom-page-wish', plugin_dir_url( __FILE__ ) . 'css/ns-option-css-custom-page.css');
	wp_enqueue_script( 'ns-option-js-page-wish', plugins_url( '/js/ns-option-js-page.js' , __FILE__ ), array( 'jquery' ) );
});
?>
<?php
/*
Plugin Name: NS Woocommerce Wishlist
Plugin URI: http://www.nsthemes.com
Description: This plugin allows your visitors and registered users to create custom wishlist.
Version: 2.1.0
Author: NsThemes
Author URI: http://www.nsthemes.com
License: GNU General Public License v2.0
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/** 
 * @author        PluginEye
 * @copyright     Copyright (c) 2019, PluginEye.
 * @version         1.0.0
 * @license       https://www.gnu.org/licenses/gpl-3.0.html GNU General Public License Version 3
 * PLUGINEYE SDK
*/

require_once('plugineye/plugineye-class.php');
$plugineye = array(
    'main_directory_name'       => 'ns-wishlist-for-woocommerce',
    'main_file_name'            => 'ns-woocommerce-wishlist.php',
    'redirect_after_confirm'    => 'admin.php?page=ns-wishlist-for-woocommerce%2Fns-admin-options%2Fns_admin_option_dashboard.php',
    'plugin_id'                 => '218',
    'plugin_token'              => 'NWNmZTY5OTU4MjNkOWJjODNjYmIyZDZkY2JhOTM0ZGVlZGI2OTU2MDlkZDNhZTY4OWE3MmIyMTBhOGYxYjg2ZjZiMWJjNGM2OGQzNDg=',
    'plugin_dir_url'            => plugin_dir_url(__FILE__),
    'plugin_dir_path'           => plugin_dir_path(__FILE__)
);

$plugineyeobj218 = new pluginEye($plugineye);
$plugineyeobj218->pluginEyeStart();

/* *** plugin review trigger *** */
require_once( plugin_dir_path( __FILE__ ) .'/class/class-plugin-theme-review-request.php');

/* *** include frontend js *** */
function ns_woocommerce_wishlist_load_js( $hook ) {      
        wp_enqueue_script( 'ns-woocommerce-wishlist',  plugin_dir_url( __FILE__ ).'assets/js/ns-woocommerce-wishlist.js', array( 'jquery' ), false, true );
        wp_enqueue_script( 'ns-woocommerce-wishlist-dialog',  plugin_dir_url( __FILE__ ).'assets/js/ns_mail_dialog_wishlist.js', array( 'jquery', 'jquery-ui-dialog' ), false, true );
        wp_localize_script( 'ns-woocommerce-wishlist', 'nsaddtowish', array( 'ajax_url' => admin_url( 'admin-ajax.php' ))); 
        wp_localize_script( 'ns-woocommerce-wishlist', 'nsremovetowish', array( 'ajax_url' => admin_url( 'admin-ajax.php' ))); 
        wp_localize_script( 'ns-woocommerce-wishlist-dialog', 'nsdialogwish', array( 'ajax_url' => admin_url( 'admin-ajax.php' )));
        add_thickbox();
}
add_action( 'wp_enqueue_scripts', 'ns_woocommerce_wishlist_load_js' );


/* *** include frontend css *** */
function ns_woocommerce_wishlist_load_css($hook) {
        wp_enqueue_style( 'font-awesome-min', plugin_dir_url( __FILE__ ).'assets/css/font-awesome.min.css', array(), '1.0.0' );
        wp_enqueue_style( 'all-min', plugin_dir_url( __FILE__ ).'assets/css/all.min.css', array(), '1.0.0' );  
        wp_enqueue_style( 'ns-woocommerce-wishlist-style', plugin_dir_url( __FILE__ ).'assets/css/ns-woocommerce-wishlist-style.css', array(), '1.0.0' ); 
       
}
add_action( 'wp_enqueue_scripts', 'ns_woocommerce_wishlist_load_css' );

/* *** include loop product *** */
require_once( plugin_dir_path( __FILE__ ).'/ns-woocommerce-wishlist-loop-product.php');

/* *** include single product *** */
require_once( plugin_dir_path( __FILE__ ).'/ns-woocommerce-wishlist-single-product.php');

/* *** include register option *** */
require_once( plugin_dir_path( __FILE__ ).'/ns-woocommerce-wishlist-register-option.php');

/* *** include share wishlist *** */
require_once( plugin_dir_path( __FILE__ ).'/ns-woocommerce-wishlist-share.php');

/* *** include share wishlist mail *** */
require_once( plugin_dir_path( __FILE__ ).'/ns-woocommerce-wishlist-send-mail.php');

/* *** include file where we print our wishlist *** */
require_once( plugin_dir_path( __FILE__ ).'/print-wishlist/ns-woocommerce-wishlist-print.php');

/* *** include file where we print our wishlist *** */
require_once( plugin_dir_path( __FILE__ ).'/print-wishlist/ns-woocommerce-wishlist-print-for-visitors.php');

/* *** include plugin option *** */
require_once( plugin_dir_path( __FILE__ ).'ns-admin-options/ns-admin-options-setup.php');


add_action( 'wp_ajax_nopriv_ns_addtowish', 'ns_addtowish' );
add_action( 'wp_ajax_ns_addtowish', 'ns_addtowish' );
function ns_addtowish(){
   
    if ( isset($_POST['nsadd_wish'] ) ){
        if(is_user_logged_in()){ //se l'utente è loggato

            $ns_saved_wishlist = get_user_meta(get_current_user_id(), "ns_user_wishlist", true); //prendo l'usermeta dal db
            if($ns_saved_wishlist == ''){//se non è ancora presente
                //$array = array();
                $array[sanitize_text_field($_POST['nsadd_wish'])] = array(date('Y-m-d H:i:s'));
                add_user_meta( get_current_user_id(), "ns_user_wishlist", $array);
            }
            else{
                //if(in_array($_POST['nsadd_wish'], $ns_saved_wishlist)) die();
                // array_push($ns_saved_wishlist, array(sanitize_text_field($_POST['nsadd_wish']), date('Y-m-d H:i:s')));
                if(isset($ns_saved_wishlist[$_POST['nsadd_wish']])) die();
                $ns_saved_wishlist[sanitize_text_field($_POST['nsadd_wish'])] = array(date('Y-m-d H:i:s'));
                update_user_meta( get_current_user_id(), "ns_user_wishlist", $ns_saved_wishlist);
            }
        }else{ 
            if (!isset($_COOKIE["ns_nsww_cookie"])) {
                $ns_wishilist_str = ','.$_POST['nsadd_wish'].',';
                setcookie("ns_nsww_cookie", $ns_wishilist_str, time()+7200, '/'); /* expire in 2 hour */
            }else{
                $nspos = strpos($_COOKIE["ns_nsww_cookie"], $_POST['nsadd_wish']);
                if ($nspos === false) {
                    $ns_wishilist_str = $_COOKIE["ns_nsww_cookie"].$_POST['nsadd_wish'].',';
                    setcookie("ns_nsww_cookie", $ns_wishilist_str, time()+7200, '/'); /* expire in 2 hour */
                }
                else
                    die();
            }
        }
         
        
        //$ns_pro = new WC_Product($_POST['nsadd_wish']);
        $ns_pro = wc_get_product($_POST['nsadd_wish']);
        $add_to_cart_ns = do_shortcode('[add_to_cart_url id="'.$_POST['nsadd_wish'].'"]');
        echo '<div class="nspriceboxcontent rem'.$_POST['nsadd_wish'].'">';
        echo '<div class="ns-prod-boxsmall">'.$ns_pro->get_image().'</div>';
        echo '<div class="ns-prod-boxsmall"><a href="'.$ns_pro->get_permalink().'">'.$ns_pro->get_title().'</a></div>';
        //echo '<div class="ns-prod-boxsmall-price">'.ns_display_price($ns_pro->get_sale_price(), $ns_pro->get_regular_price()).'</div>';
        echo '<div class="ns-prod-boxsmall-price">'.$ns_pro->get_price_html().'</div>';
        echo '<div class="ns-prod-boxsmall"><div class="ns-wishlist-iconswidget"><a href="'.$add_to_cart_ns.'"><i class="fas fa-cart-plus fa-lg"></i></a></div><div class="nswr'.$_POST['nsadd_wish'].' removewishclass" data-id="'.$_POST['nsadd_wish'].'"><i class="fas fa-times-circle fa-lg ns-wishlist-iconswidget"></i></div></div>';
        echo '</div>';
        
        die();

    } 
    
}



add_action( 'wp_ajax_nopriv_ns_removetowish', 'ns_removetowish' );
add_action( 'wp_ajax_ns_removetowish', 'ns_removetowish' );
function ns_removetowish(){
    if ( isset($_POST['nsremove_wish'] ) ){
        if(is_user_logged_in()){ //se l'utente è loggato
            $ns_saved_wishlist = get_user_meta(get_current_user_id(), "ns_user_wishlist", true); //prendo l'usermeta dal db
            if($ns_saved_wishlist == '') die(); //se non è ancora presente
            else{
                unset($ns_saved_wishlist[$_POST['nsremove_wish']]);
                update_user_meta( get_current_user_id(), "ns_user_wishlist", $ns_saved_wishlist);
                if(empty($ns_saved_wishlist)) 
                    echo json_encode(array("is_last", $_POST['nsremove_wish']));
                else
                    echo json_encode(array("is_not_last", $_POST['nsremove_wish']));
            }
        }else{ 
            $ns_wishinit_str = $_COOKIE["ns_nsww_cookie"];
            $ns_1clean_str = str_replace(','.$_POST['nsremove_wish'].',', ',', $ns_wishinit_str);
            $ns_2clean_str = str_replace(',,', ',', $ns_1clean_str);
            // CLEAN COOKIE
            setcookie("ns_nsww_cookie", $ns_2clean_str, time()+3600, '/');  /* expire in 1 hour */
            if($ns_2clean_str == ",")
                echo json_encode(array("is_last", $_POST['nsremove_wish']));
            else
                echo json_encode(array("is_not_last", $_POST['nsremove_wish']));
        }
        die();
    }
}

add_action( 'wp_ajax_nopriv_ns_send_mail', 'ns_send_mail' );
add_action( 'wp_ajax_ns_send_mail', 'ns_send_mail' );
function ns_send_mail(){
    if(!isset($_POST['ns_mail_send_to']) || !isset($_POST['ns_mail_sender_name'])) die();

    add_filter( 'wp_mail_from_name', function( $name ) {
        return $_POST['ns_mail_sender_name'];
    });
    
    add_filter( 'wp_mail_from', function( $email ) {

        $user = get_userdata(get_current_user_id());
        return $user->user_email;
    });

    $ns_mail_subject = "Check ".$_POST['ns_mail_sender_name']."'s wishlist";
    $ns_mail_title = get_bloginfo();
    $ns_mail_link = get_permalink(get_option("ns-wishlist-page"))."?id=".get_current_user_id();

    $ns_array_send_to = explode(", ", $_POST['ns_mail_send_to']);
    $ns_response = "done";
    foreach($ns_array_send_to as $user){
        if(!wp_mail($user, $ns_mail_subject, ns_send_mail_wishlist($ns_mail_title, $ns_mail_link, $_POST['ns_mail_sender_name']), array('Content-Type: text/html; charset=UTF-8')))
            $ns_response = "error";
    }
    echo $ns_response;
    die();
}

/**
 * Function used for update data when user log on.
 * if user is using wishlist as anonymous user when logging in
 * wishlist stored in DB will update
 */
function ns_save_cookie_on_login($user_login, $user) {
    /*
    if cookie is present, parse it and save values in db!
    */
    if(!isset($_COOKIE["ns_nsww_cookie"]) || $_COOKIE["ns_nsww_cookie"] == ',') return;
    $sub_coma = substr($_COOKIE["ns_nsww_cookie"], 1, -1);
    $ns_products = explode(",", $sub_coma);

    if(empty($ns_products)) return;
    $ns_saved_wishlist = get_user_meta($user->ID, "ns_user_wishlist", true); //prendo l'usermeta dal db

    foreach($ns_products as $product){
        $ns_saved_wishlist[$product] = array(date('Y-m-d H:i:s'));
    }
    update_user_meta( $user->ID, "ns_user_wishlist", $ns_saved_wishlist);
}
add_action('wp_login', 'ns_save_cookie_on_login', 10, 2);


//[nstbshortcode] [product id="99"]
function ns_tb_shortcode_plugin( $atts ) {

    $print_ns_short = ns_print_wishlist('modal');
	if (get_option('ns_whislist_modal_link', 'My wishlist')) {
		$my_wishlist_label = get_option('ns_whislist_modal_link', 'My wishlist');
	} else {
		$my_wishlist_label = 'My Wishlist';
	}
    return '<div id="my-content-id" style="display:none;"><div class="widNSmodal" id="ns_my_wishlist">' . $print_ns_short . '</div></div><a href="#TB_inline?width=600&height=550&inlineId=my-content-id" class="thickbox">'.$my_wishlist_label.'</a>';
}
add_shortcode( 'nstbshortcode', 'ns_tb_shortcode_plugin' );



//[nstbshortcodeviewpage] [product id="99"]
function ns_tb_shortcode_plugin_page_view( $atts ) {

    if(isset($_GET['id'])){
        $print_ns_short = ns_print_wishlist_for_visitors(sanitize_text_field($_GET['id']));
    }else{
        $print_ns_short = ns_print_wishlist('page');
    }
    return '<div class="widNSmodal" id="ns_my_wishlist">' . $print_ns_short . '</div>';
}
add_shortcode( 'nstbshortcodeviewpage', 'ns_tb_shortcode_plugin_page_view' );


/**
 * THis function is used for know if an woocmmerce 
 * product is saved in our wishlist and print a differnet 
 * "add to wishlist" button.
 */
function ns_print_differnt_button_if_is_in_wishlist($ns_post_id){
    //return true if is in wishlist, else false
    if(is_user_logged_in()){
        $ns_saved_wishlist = get_user_meta(get_current_user_id(), "ns_user_wishlist", true); //prendo l'usermeta dal db
        if($ns_saved_wishlist == '') return FALSE;
        //return in_array($ns_post_id, $ns_saved_wishlist);
        foreach($ns_saved_wishlist as $ns_key => $ns_product){
            if(is_array($ns_product))
                $ns_product = $ns_key;
            if($ns_product == $ns_post_id)
                return TRUE;
        }
        return FALSE;
    }else if (!isset($_COOKIE["ns_nsww_cookie"])) return FALSE;
    $nspos = strpos($_COOKIE["ns_nsww_cookie"], $ns_post_id);
    if ($nspos === FALSE) return FALSE;
    return TRUE;
}

/* *** include widget *** */
require_once( plugin_dir_path( __FILE__ ).'/ns-woocommerce-wishlist-widget.php');

/* *** add link premium *** */
add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'nswishlist_add_action_links' );

function nswishlist_add_action_links ( $links ) {	
 $mylinks = array('<a id="nswishlistlinkpremium" href="https://www.nsthemes.com/product/woocommerce-wishlist/?ref-ns=2&campaign=WFW-linkpremium" target="_blank">'.__( 'Premium Version', 'ns-facebook-pixel-for-wp' ).'</a>');
return array_merge( $links, $mylinks );
}


?>
<?php
function ns_print_wishlist_for_visitors($id){

    $print_ns_short = '<div class="NsEmptytoHide">Empty Wishilist!</div>';
    
    $ns_products = get_user_meta($id, "ns_user_wishlist", true); //prendo l'usermeta dal db
    if($ns_products != ''){ //se non è ancora presente
        $print_ns_short = '';
        foreach ($ns_products as $ns_key => $ns_product) {
            //$ns_pro = new WC_Product($ns_product);
            if(is_array($ns_product))
                $ns_product = $ns_key;
            $ns_pro = wc_get_product($ns_product);
            $add_to_cart_ns = do_shortcode('[add_to_cart_url id="'.$ns_product.'"]');
            $print_ns_short .= '<div class="nspriceboxcontent" id="rem'.$ns_product.'">';
            $print_ns_short .= '<div class="ns-prod-boxsmall">'.$ns_pro->get_image().'</div>';
            $print_ns_short .= '<div class="ns-prod-boxsmall"><a href="'.$ns_pro->get_permalink().'">'.$ns_pro->get_title().'</a></div>';
            //$print_ns_short .= '<div class="ns-prod-boxsmall-price">'.ns_display_price($ns_pro->get_sale_price(), $ns_pro->get_regular_price()).'</div>';
            $print_ns_short .= '<div class="ns-prod-boxsmall-price">'.$ns_pro->get_price_html().'</div>';
            $print_ns_short .= '<div class="ns-prod-boxsmall"><div><a href="'.$add_to_cart_ns.'"><i class="fas fa-cart-plus fa-lg"></i></a></div></div>';
            $print_ns_short .= '</div>';
        }  
    } 
    return $print_ns_short;
}
?>
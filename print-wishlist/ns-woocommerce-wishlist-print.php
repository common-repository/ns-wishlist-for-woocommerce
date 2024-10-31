<?php

function ns_print_wishlist($type = ''){  //$type can be: 'widget', 'page, 'modal'

    $print_ns_short = '';
    if(is_user_logged_in()){ //se l'utente è loggato
        $ns_products = get_user_meta(get_current_user_id(), "ns_user_wishlist", true); //prendo l'usermeta dal db
    }else if (isset($_COOKIE["ns_nsww_cookie"]) && $_COOKIE["ns_nsww_cookie"] != ',') {
        $sub_coma = substr($_COOKIE["ns_nsww_cookie"], 1, -1);
        $ns_products = explode(",", $sub_coma);
    }else{
        // $print_ns_short .= '<div class="ns-div-share-on-wishlist" style="display:none;"><span class="ns-span-class-share"><i class="fas fa-share-alt"></i> Share on: </span><div class="ns-div-open-modal"><img src="'.plugin_dir_url( __FILE__ ).'assets/img/ns-share-by-mail.png" height="40" width="40"></div></div>';
        $print_ns_short .= 
            '<div class="ns-div-share-on-wishlist" style="display:none;">
                <div class="ns-div-class-share">
                    <span class="ns-span-class-share">
                        <i class="fas fa-share-alt"></i> 
                        Share on: 
                    </span>
                </div>';
        if(is_user_logged_in())
            $print_ns_short .='
                <div class="ns-div-open-modal ns-share-imgs-margin">
                    <img src="'.plugin_dir_url( __FILE__ ).'../assets/img/ns-share-by-mail.png" height="30" width="30">
                </div>
                <div class="ns-div-whatsapp ns-share-imgs-margin">
                    <a href="https://api.whatsapp.com/send?text='.get_ns_ww_wa_msg().'" target="_blank""><img src="'.plugin_dir_url( __FILE__ ).'../assets/img/whatsapp.svg" height="30" width="30"></a>
                </div>';
        else
            $print_ns_short .='
                <div class="ns-div-open-modal ns-share-imgs-margin">
                    <img src="'.plugin_dir_url( __FILE__ ).'../assets/img/ns-share-by-mail.png" class="ns-img-for-non-logged" height="30" width="30">
                </div>
                <div class="ns-div-whatsapp ns-share-imgs-margin">
                    <img src="'.plugin_dir_url( __FILE__ ).'../assets/img/whatsapp.svg" class="ns-img-for-non-logged" height="30" width="30">
                </div>
            </div>
            <div class="NsEmptytoHide">Empty Wishilist!</div>';
        return $print_ns_short;
    }
    $print_ns_short .= '<div class="ns-div-share-on-wishlist" ';
        if(empty($ns_products)) 
            $print_ns_short .= 'style="display:none;"'; 
        $print_ns_short .= '>
                <div class="ns-div-class-share">
                    <span class="ns-span-class-share">
                        <i class="fas fa-share-alt"></i> 
                        Share on: 
                    </span>
                </div>';
        if(is_user_logged_in())
            $print_ns_short .='
                <div class="ns-div-open-modal ns-share-imgs-margin">
                    <img src="'.plugin_dir_url( __FILE__ ).'../assets/img/ns-share-by-mail.png" height="30" width="30">
                </div>
                <div class="ns-div-whatsapp ns-share-imgs-margin">
                    <a href="https://api.whatsapp.com/send?text='.get_ns_ww_wa_msg().'" target="_blank""><img src="'.plugin_dir_url( __FILE__ ).'../assets/img/whatsapp.svg" height="30" width="30"></a>
                </div>';
        else
            $print_ns_short .='
                <div class="ns-div-open-modal ns-share-imgs-margin">
                    <img src="'.plugin_dir_url( __FILE__ ).'../assets/img/ns-share-by-mail.png" class="ns-img-for-non-logged" height="30" width="30">
                </div>
                <div class="ns-div-whatsapp ns-share-imgs-margin">
                    <img src="'.plugin_dir_url( __FILE__ ).'../assets/img/whatsapp.svg" class="ns-img-for-non-logged" height="30" width="30">
                </div>';
        $print_ns_short .='
                </div>';
        if($ns_products)
            foreach ($ns_products as $ns_key => $ns_product) {
                $show_date = FALSE;
                $class_for_show_date = '';
                if(is_array($ns_product)){
                    $creation_date = $ns_product[0];
                    $ns_product = $ns_key;
                    if($type == 'page'){
                        $show_date = TRUE;
                        $class_for_show_date = 'ns-show-date-css';
                    }
                }
                //$ns_pro = new WC_Product($ns_product);
                $ns_pro = wc_get_product($ns_product);
                $add_to_cart_ns = do_shortcode('[add_to_cart_url id="'.$ns_product.'"]');
                $print_ns_short .= '<div class="nspriceboxcontent rem'.$ns_product.'">';
                $print_ns_short .= '<div class="ns-prod-boxsmall '.$class_for_show_date.'">'.$ns_pro->get_image().'</div>';
                $print_ns_short .= '<div class="ns-prod-boxsmall '.$class_for_show_date.'"><a href="'.$ns_pro->get_permalink().'">'.$ns_pro->get_title().'</a></div>';
                //$print_ns_short .= '<div class="ns-prod-boxsmall-price">'.ns_display_price($ns_pro->get_sale_price(), $ns_pro->get_regular_price()).'</div>';
                $print_ns_short .= '<div class="ns-prod-boxsmall-price '.$class_for_show_date.'">'.$ns_pro->get_price_html().'</div>';
                if($show_date)
                    $print_ns_short .= '<div class="ns-prod-boxsmall '.$class_for_show_date.'">'.$creation_date.'</div>';

                $print_ns_short .= '
                    <div class="ns-prod-boxsmall '.$class_for_show_date.'">
                        <div class="ns-wishlist-icons-container">
                            <a href="'.$add_to_cart_ns.'" class="ns-wishlist-icons'.$type.'"><i class="fas fa-cart-plus fa-lg"></i></a>
                        </div>
                        <div class="nswr'.$ns_product.' removewishclass ns-wishlist-icons-container" data-id="'.$ns_product.'""">
                            <i class="fas fa-times-circle fa-lg ns-wishlist-icons'.$type.'"></i>
                        </div>
                    </div>';
                $print_ns_short .= '</div>';
            }
        else{
            $print_ns_short .= '<div class="NsEmptytoHide">Empty Wishilist!</div>';
        }

        return $print_ns_short;


    // $print_ns_short = '';
    // if(is_user_logged_in() || (isset($_COOKIE["ns_nsww_cookie"]) && $_COOKIE["ns_nsww_cookie"] != ',')){
    //     if(is_user_logged_in()){ //se l'utente è loggato
    //         $ns_products = get_user_meta(get_current_user_id(), "ns_user_wishlist", true); //prendo l'usermeta dal db
    //     }else if (isset($_COOKIE["ns_nsww_cookie"]) && $_COOKIE["ns_nsww_cookie"] != ',') {
    //         $sub_coma = substr($_COOKIE["ns_nsww_cookie"], 1, -1);
    //         $ns_products = explode(",", $sub_coma);
    //     }
    //     $print_ns_short .= '<div class="ns-div-share-on-wishlist" ';
    //     if(empty($ns_products)) 
    //         $print_ns_short .= 'style="display:none;"'; 
    //     $print_ns_short .= '>
    //             <div class="ns-div-class-share">
    //                 <span class="ns-span-class-share">
    //                     <i class="fas fa-share-alt"></i> 
    //                     Share on: 
    //                 </span>
    //             </div>';
    //     if(is_user_logged_in())
    //         $print_ns_short .='
    //             <div class="ns-div-open-modal ns-share-imgs-margin">
    //                 <img src="'.plugin_dir_url( __FILE__ ).'../assets/img/ns-share-by-mail.png" height="30" width="30">
    //             </div>
    //             <div class="ns-div-whatsapp ns-share-imgs-margin">
    //                 <a href="https://api.whatsapp.com/send?text='.get_ns_ww_wa_msg().'" target="_blank""><img src="'.plugin_dir_url( __FILE__ ).'../assets/img/whatsapp.svg" height="30" width="30"></a>
    //             </div>';
    //     else
    //         $print_ns_short .='
    //             <div class="ns-div-open-modal ns-share-imgs-margin">
    //                 <img src="'.plugin_dir_url( __FILE__ ).'../assets/img/ns-share-by-mail.png" class="ns-img-for-non-logged" height="30" width="30">
    //             </div>
    //             <div class="ns-div-whatsapp ns-share-imgs-margin">
    //                 <img src="'.plugin_dir_url( __FILE__ ).'../assets/img/whatsapp.svg" class="ns-img-for-non-logged" height="30" width="30">
    //             </div>';
    //     $print_ns_short .='
    //             </div>';
    //     if($ns_products)
    //         foreach ($ns_products as $ns_key => $ns_product) {
    //             $show_date = FALSE;
    //             $class_for_show_date = '';
    //             if(is_array($ns_product)){
    //                 $creation_date = $ns_product[0];
    //                 $ns_product = $ns_key;
    //                 if($type == 'page'){
    //                     $show_date = TRUE;
    //                     $class_for_show_date = 'ns-show-date-css';
    //                 }
    //             }
    //             //$ns_pro = new WC_Product($ns_product);
    //             $ns_pro = wc_get_product($ns_product);
    //             $add_to_cart_ns = do_shortcode('[add_to_cart_url id="'.$ns_product.'"]');
    //             $print_ns_short .= '<div class="nspriceboxcontent rem'.$ns_product.'">';
    //             $print_ns_short .= '<div class="ns-prod-boxsmall '.$class_for_show_date.'">'.$ns_pro->get_image().'</div>';
    //             $print_ns_short .= '<div class="ns-prod-boxsmall '.$class_for_show_date.'"><a href="'.$ns_pro->get_permalink().'">'.$ns_pro->get_title().'</a></div>';
    //             //$print_ns_short .= '<div class="ns-prod-boxsmall-price">'.ns_display_price($ns_pro->get_sale_price(), $ns_pro->get_regular_price()).'</div>';
    //             $print_ns_short .= '<div class="ns-prod-boxsmall-price '.$class_for_show_date.'">'.$ns_pro->get_price_html().'</div>';
    //             if($show_date)
    //                 $print_ns_short .= '<div class="ns-prod-boxsmall '.$class_for_show_date.'">'.$creation_date.'</div>';

    //             $print_ns_short .= '
    //                 <div class="ns-prod-boxsmall '.$class_for_show_date.'">
    //                     <div class="ns-wishlist-icons-container">
    //                         <a href="'.$add_to_cart_ns.'" class="ns-wishlist-icons'.$type.'"><i class="fas fa-cart-plus fa-lg"></i></a>
    //                     </div>
    //                     <div class="nswr'.$ns_product.' removewishclass ns-wishlist-icons-container" data-id="'.$ns_product.'""">
    //                         <i class="fas fa-times-circle fa-lg ns-wishlist-icons'.$type.'"></i>
    //                     </div>
    //                 </div>';
    //             $print_ns_short .= '</div>';
    //         }
    //     else{
    //         $print_ns_short .= '<div class="NsEmptytoHide">Empty Wishilist!</div>';
    //     }
        
    // }else {
    //     // $print_ns_short .= '<div class="ns-div-share-on-wishlist" style="display:none;"><span class="ns-span-class-share"><i class="fas fa-share-alt"></i> Share on: </span><div class="ns-div-open-modal"><img src="'.plugin_dir_url( __FILE__ ).'assets/img/ns-share-by-mail.png" height="40" width="40"></div></div>';
    //     $print_ns_short .= 
    //         '<div class="ns-div-share-on-wishlist" style="display:none;">
    //             <div class="ns-div-class-share">
    //                 <span class="ns-span-class-share">
    //                     <i class="fas fa-share-alt"></i> 
    //                     Share on: 
    //                 </span>
    //             </div>';
    //     if(is_user_logged_in())
    //         $print_ns_short .='
    //             <div class="ns-div-open-modal ns-share-imgs-margin">
    //                 <img src="'.plugin_dir_url( __FILE__ ).'../assets/img/ns-share-by-mail.png" height="30" width="30">
    //             </div>
    //             <div class="ns-div-whatsapp ns-share-imgs-margin">
    //                 <a href="https://api.whatsapp.com/send?text='.get_ns_ww_wa_msg().'" target="_blank""><img src="'.plugin_dir_url( __FILE__ ).'../assets/img/whatsapp.svg" height="30" width="30"></a>
    //             </div>';
    //     else
    //         $print_ns_short .='
    //             <div class="ns-div-open-modal ns-share-imgs-margin">
    //                 <img src="'.plugin_dir_url( __FILE__ ).'../assets/img/ns-share-by-mail.png" class="ns-img-for-non-logged" height="30" width="30">
    //             </div>
    //             <div class="ns-div-whatsapp ns-share-imgs-margin">
    //                 <img src="'.plugin_dir_url( __FILE__ ).'../assets/img/whatsapp.svg" class="ns-img-for-non-logged" height="30" width="30">
    //             </div>
    //         </div>
    //         <div class="NsEmptytoHide">Empty Wishilist!</div>';
    // }
    // return $print_ns_short;
}


function get_ns_ww_wa_msg(){
    return 'Hi, why not you take a look at my wishlist? You can find the right gift for me!
    '.urlencode(get_permalink(get_option("ns-wishlist-page"))."?id=".get_current_user_id());
}
?>
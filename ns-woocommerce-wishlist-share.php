<?php

function ns_woocommerce_share_wishlist(){
    ?>
    <div class="ns-modal-wishlist-layer"><!-- layer -->
        
        <div class="ns-modal-wishlist">
            
                
            <div id="ns-close-modal">
                <i class="fas fa-times fa-2x"></i>
            </div>
            
            <br>
            <div class="ns-modal-title-span">Share your Wishlist</div>
            <div class="ns-wp-name-site">
                <i class="fas fa-list-ol"></i>
                <?php echo get_bloginfo(); ?>  
            </div>
            <?php 
                if(is_user_logged_in()){
            ?>
                    <div class="ns-div-success ns-div-response">
                        <img src="<?php echo plugin_dir_url( __FILE__ ).'assets/img/ns-checked.svg';?>" width="100" class="ns-div-image-done">
                        <br><br>
                        <span>Mail sent successfully!</span>
                    </div>
                    <div class="ns-div-error ns-div-response">
                        <img src="<?php echo plugin_dir_url( __FILE__ ).'assets/img/ns-error.svg';?>" width="100" class="ns-div-image-done">
                        <br><br>
                        <span>An error occurred!</span><br>
                        <input type="button" value="try again" class="ns-try-again">
                    </div>
                    <div class="ns-textarea-size">
                        <span><b>Your name:</b></span>
                        <input type="text" id="ns-your-name" name="name" placeholder="John">

                        <span><b>Share your wishlist with:</b></span>
                    
                        <textarea name="testo" class="ns-textarea-dialog" rows="5" placeholder="Insert your emails, for example: example@example.com, example2@example.com, example3@example.com"></textarea>
                    </div>
                    <div class="ns-div-share-now">
                        <input type="button" id="ns-share-now" name="share" value="Share now!">
                    </div>
             <?php 
                }else{
                    echo "<div class=\"ns-div-logged-in\">You must be logged in to share your wishlist!</span>";
                }

            ?>
        </div>
    </div>
    
    <?php
}
add_action('wp_footer', 'ns_woocommerce_share_wishlist');
?>
<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<?php // PUT YOUR settings_fields name and your input // ?>
<?php settings_fields('ns_wishlist_options_group'); ?>
<div class="genRowNssdc">
<!-- <table class="form-table adjTblNs">
	<tr valign="top">
	<th scope="row">
		<label>Fast tutorial!</label>
	</th>
	</tr>
	<tr valign="top">
		<td colspan="2">
			<span style="font-size: 13px">
				<p>Display Wishlist :</p>
				 <p>
                    - use shortcode: <strong>[nstbshortcodeviewpage]</strong> for display wishlist in a single page or post<br>
                    - use shortcode: <strong>[nstbshortcode]</strong> for display wishlist link (this link will open a modal)<br>
                    - use <strong>widget</strong> "NS Wishlist" to display wishlist in sidebar<br>
		        </p>                   
			</span>
		</td>
	</tr>
	<tr>
		<th><label for="ns_whislist_label">Wishlist label</label></th>
		<td><input class="regular-text" type="text" placeholder="Add to wishlist" id="ns_whislist_label" name="ns_whislist_label" value ="<?php echo get_option('ns_whislist_label', ''); ?>"></td>
	</tr>	
	<tr>
		<th><label for="ns_whislist_modal_link">Wishlist modal link</label></th>
		<td><input class="regular-text" type="text" placeholder="My wishlist" id="ns_whislist_modal_link" name="ns_whislist_modal_link" value ="<?php echo get_option('ns_whislist_modal_link', ''); ?>"></td>
	</tr>
</table>	 -->
	<script>
		function nsWishlistCopyToClipboard(element) {
			var $temp = jQuery("<input>");
			jQuery("body").append($temp);
			$temp.val(jQuery(element).text()).select();
			document.execCommand("copy");
			$temp.remove();
		}
	</script>

	<div class="ns-container-settings">
		<div class="ns-container-options-wishlist">
			<h2>Fast tutorial!</h2>
		</div>
		<hr class="ns-hr-class">
		<div class="ns-container-options-wishlist">
			<span style="font-size: 13px">
				<p>Display Wishlist :</p>
				<p>
				- use shortcode:
					<span class="ns-wishlist-tooltip">
						<strong>
							<span id="ns-wishlist-to-copy1" onClick="nsWishlistCopyToClipboard('#ns-wishlist-to-copy1')">[nstbshortcodeviewpage]</span>
						</strong>
  						<span class="ns-wishlist-tooltiptext">Click to copy shortcode</span>
					</span > 
					for display wishlist in a single page or post<br>
				
					- use shortcode:
					<span class="ns-wishlist-tooltip">
						<strong>
							<span id="ns-wishlist-to-copy2" onClick="nsWishlistCopyToClipboard('#ns-wishlist-to-copy2')">[nstbshortcode]</span>
						</strong>
  						<span class="ns-wishlist-tooltiptext">Click to copy shortcode</span>
					</span > 
					for display wishlist link (this link will open a modal)<br>
				- use <strong>widget</strong> "NS Wishlist" to display wishlist in sidebar<br>
				</p>                   
			</span>
		</div>
	</div>

	<div class="ns-container-settings">
		<div class="ns-container-options-wishlist">
			<h2>NS Wishlist for WooCommerce Settings</h2>
		</div>
		<hr class="ns-hr-class">
		<div class="ns-container-options-wishlist">
			<table>
				<tr>
					<td><label for="ns_whislist_label">Wishlist Custom Page: </label></td>
					<td>
						<select id="ns-wishlist-page" name="ns-wishlist-page">
						<?php 
							$pages = get_pages();
							$ns_page_saved = get_option("ns-wishlist-page");
							$option = '<option value="choose">Choose</option>';
							echo $option;
							foreach ( $pages as $page ) {
								$option = '<option value="' . $page->ID.'"';
								if($page->ID == $ns_page_saved)
									$option .= ' selected="selected"';
								$option .= '>';
								$option .= $page->post_title;
								$option .= '</option>';
								echo $option;
							}
						?>
						</select>
					</td>
					
				</tr>
				<tr>
					<td><label for="ns_whislist_label">Wishlist label: </label></td>
					<td><input class="regular-text" type="text" placeholder="Add to wishlist" id="ns_whislist_label" name="ns_whislist_label" value ="<?php echo get_option('ns_whislist_label', ''); ?>"></td>
				</tr>
				<tr>
					<td><label for="ns_whislist_modal_link">Wishlist modal link name: </label></td>
					<td><input class="regular-text" type="text" placeholder="My wishlist" id="ns_whislist_modal_link" name="ns_whislist_modal_link" value ="<?php echo get_option('ns_whislist_modal_link', ''); ?>"></td>
				</tr>
				<tr>	
					<td><label for="ns_wishlist_label_font_pre">Wishlist <a href="https://fontawesome.com/icons?d=gallery" target="_blank">Font-Awesome</a> standard: </label></td>
					<td><textarea id="ns_wishlist_font_awesome_pre" placeholder="When product is not in wishlist" name="ns_wishlist_font_awesome_pre"><?php echo get_option('ns_wishlist_font_awesome_pre', '<i class="fas fa-heart"></i>'); ?></textarea></td>
				</tr>
				<tr>	
					<td><label for="ns_wishlist_label_font_post">Wishlist <a href="https://fontawesome.com/icons?d=gallery" target="_blank">Font-Awesome</a> on click: </label></td>
					<td><textarea id="ns_wishlist_font_awesome_post" placeholder="When user click on 'Add to wishlist'" name="ns_wishlist_font_awesome_post"><?php echo get_option('ns_wishlist_font_awesome_post', '<i class="fas fa-heartbeat"></i>'); ?></textarea></td>
				</tr>
			</table>
			<br><br>
			<input type="submit" class="button-primary" id="submit" name="submit" value="Save Changes">
		</div>
	</div>



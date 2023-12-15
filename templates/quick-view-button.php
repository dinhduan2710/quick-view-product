<?php
/**
 * Quick view button template
 * Note: please, do not remove $this->button_data_attr() function from button when will rewrite template
 */
?>
<div class="quick-view">
	<a href="#" class="quick-view-btn"<?php echo $this->button_data_attr(); ?>><?php
		esc_html_e( 'Quick View', 'woocommerce-quick-view' );
	?></a>
</div>
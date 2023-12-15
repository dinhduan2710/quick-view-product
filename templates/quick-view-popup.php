<?php
/**
 * Quick View popup template.
 * Note: please do not remove 'quick-view-popup' class from popup wrapper and 'quick-view-popup__content' class from content holder.
 */
?>
<div class="quick-view-popup">
	<div class="quick-view-popup__overlay"></div>
	<div class="quick-view-popup__content"><?php
		$this->popup_loader();
	?></div>
	<?php $this->prev_next_buttons(); ?>
	<?php $this->close_button(); ?>
</div>
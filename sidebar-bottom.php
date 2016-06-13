<?php
/**
 * The sidebar containing the bottom widget area.
 *
 * @package Hovercraft
 */

if ( ! is_active_sidebar( 'sidebar-2' ) ) {
	return;
}
?>

<div id="tertiary" class="widget-area">
	<?php dynamic_sidebar( 'sidebar-2' ); ?>
</div><!-- #secondary -->

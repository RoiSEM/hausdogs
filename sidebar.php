<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package huasdogs
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>
<section>
	<aside id="secondary" class="widget-area container">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</aside><!-- #secondary -->
</section>

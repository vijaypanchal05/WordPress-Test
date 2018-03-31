<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package customppl lite
 */

if ( ! is_active_sidebar( 'customppl-lite-sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area" role="complementary">
	<?php dynamic_sidebar( 'customppl-lite-sidebar-1' ); ?>
</aside><!-- #secondary -->
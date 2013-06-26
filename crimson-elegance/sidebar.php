<?php
/**
 * The Sidebar containing the sidebar widgets.
 *
 * @package WordPress
 * @subpackage Crimson Elegance
 * @since Crimson Elegance 1.0
 */
?>

	<dl id="sidebar">
<?php if( is_category('downloads') ) : ?>
		<div id="recent" class="widget">
			<dt><?php _e('Recently Added', 'crimson-elegance'); ?></dt>
			<ul>
				<?php get_recent_downloads(); ?>
			</ul>
		</div>

<?php elseif ( !dynamic_sidebar( 'sidebar' ) ) : ?>
		<div class="widget">
			<dt><h4><?php _e( 'Archives', 'crimson-elegance' ); ?></h4></dt>
            <ul>
                <?php wp_get_archives( 'type=monthly' ); ?>
            </ul>
		</div>

		<div id="meta" class="widget">
			<dt><h4><?php _e( 'Meta', 'crimson-elegance' ); ?></h4></dt>
            <ul>
			    <li> <?php wp_register(); ?> </li>
			    <li><?php wp_loginout(); ?></li>
                <li><?php wp_meta(); ?></li>
            </ul>
		</div>
<?php endif; ?>
	</dl>

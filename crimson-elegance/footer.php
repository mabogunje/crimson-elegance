<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after.  Calls sidebar-footer.php for bottom widgets.
 *
 * @package WordPress
 * @subpackage Crimson Elegance
 * @since Crimson Elegance 3.0
 */
?>

	<div id="footer">
		<dl>
			<dt class="textwidget">
                <img src="http://mabogunje.net/static/media/shared/img/dee.png" width="40" height="40" valign="middle" /> 
                A <a href="http://mabogunje.net/">Damola Mabogunje</a> Creation 
			</dt> 
<?php if( !dynamic_sidebar('bottombar') ) : ?>
			<dt class="widget_nav_menu">
				<ul>
                    <?php wp_list_pages('title_li=&exclude=5,11,65,71,74&sort_column=menu_order'); ?>
				</ul>
            </dt>  
<?php endif; ?>
		    <dt class="textwidget">
                <strong>ISSN: 2164-7321</strong>
			</dt> 
		</dl>
	</div>

	<?php wp_footer(); ?>
</body>
</html>

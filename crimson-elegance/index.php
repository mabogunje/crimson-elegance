<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query. 
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Crimson_Elegance
 * @since Crimson_Elegance 1.0
 */
?>

<?php 
	wp_get_current_user(); 
	get_header(); 
?>

	<div id="container">
		<div id="content">
            <?php get_template_part('filterbar'); ?>
            <?php get_template_part('loop', 'index'); ?>
            <?php trs_content_nav('nav-below'); ?>
		</div>
		
		<?php get_sidebar(); ?>
	</div>
	
	<?php get_footer(); ?>

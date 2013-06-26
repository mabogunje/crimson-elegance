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

<body>
<?php get_template_part('topbar'); ?>
	
	<div id="container">
		<div id="content">
            <?php get_template_part('filterbar'); ?>
            <?php $ord = (is_category('announcements')) ? "desc" : "asc"; query_posts('posts_per_page=-1&order=' . $ord . '&cat=' . $cat); ?>
			<?php get_template_part('loop', 'index'); ?>
		</div>
		
		<?php get_sidebar(); ?>
	</div>
	
	<?php get_footer(); ?>

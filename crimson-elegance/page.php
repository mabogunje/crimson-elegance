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
			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
				    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					    <div class="entry-content">
						    <?php the_content(); ?>
						    <?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'twentyten' ), 'after' => '</div>' ) ); ?>
					    </div>
				    </div>
			<?php endwhile; ?>
            <hr />

            <?php if(is_page('downloads')) : query_posts('category_name=downloads&posts_per_page=-1&order=desc'); ?>
                <?php get_template_part('loop','downloads'); ?>
             <?php elseif(is_page('editions')) : $cat = get_cat_id('editions'); ?>

                <?php
                    $subcats = get_categories('orderby=id&order=desc&child_of=' . $cat);
                    $sections = array();
                ?>

                <?php foreach($subcats as $subcat): $posts = get_posts('category= ' . $subcat->cat_ID . '&order=ASC&numberposts=-1'); ?>
                    <?php if((!empty($posts)) && ($subcat->category_parent != $cat)) : ?>
                        <div class="post post-editions category-<?php echo get_cat_slug($subcat->category_parent); ?>">
                            <div>
                                <h2><?php echo $subcat->name; ?></a></h2>
                                <?php echo category_description($subcat->cat_ID); ?>
                            </div>
                            <div>
                                <dl class="post-toc">
                                    <dt>In this Knot</dt>
                                    <?php query_posts('category_name=' . $subcat->slug . '&posts_per_page=3&orderby=rand&order=DESC'); ?>
                                    <?php get_template_part('loop', 'editions'); ?>
                                    <dd class="more"><a href="<?php echo get_category_link($subcat->cat_ID); ?>">Read full edition</a></dd>
                                </dl>
                            </div>
                        </div>    
            <?php endif; endforeach; ?>
	    <?php elseif(is_page('twists')) : query_posts('category_name=twists&posts_per_page=-1&order=desc'); ?>
                <?php get_template_part('loop','index'); ?>

	    <?php endif; ?>
		</div>

		<?php get_sidebar(); ?>
	</div>
	
	<?php get_footer(); ?>

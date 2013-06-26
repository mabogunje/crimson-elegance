<?php
/**
 * The loop that displays posts.
 *
 * The loop displays the posts and the post content.  See
 * http://codex.wordpress.org/The_Loop to understand it and
 * http://codex.wordpress.org/Template_Tags to understand
 * the tags used in it.
 *
 * This can be overridden in child themes with loop.php or
 * loop-template.php, where 'template' is the loop context
 * requested by a template. For example, loop-index.php would
 * be used if it exists and we ask for the loop with:
 * <code>get_template_part( 'loop', 'index' );</code>
 *
 * @package WordPress
 * @subpackage Crimson Elegance
 * @since Crimson Elegance 1.0
 */
?>

<?php /* Start the Loop. */ ?>
<?php while ( have_posts() ) : the_post(); ?>

<?php /* How to display posts */ ?>
                    <dd>
					    <a href="<?php the_permalink(); ?>"> 
						    <?php the_title(); ?>
                        </a>
                    </dd>
<?php endwhile; // End the loop. ?>

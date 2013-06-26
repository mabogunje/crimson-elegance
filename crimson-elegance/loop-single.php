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

<?php /* If there are no posts to display, such as an empty archive page */ ?>
<?php if ( ! have_posts() ) : ?>
	<div id="post-0" class="post error404 not-found">
		<h2 class="entry-title"><?php _e( 'Not Found', 'twentyten' ); ?></h2>
		<div class="entry-content">
			<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'crimson-elegance' ); ?></p>
		</div><!-- .entry-content -->
	</div><!-- #post-0 -->
<?php endif; ?>

<?php /* Start the Loop. */ ?>
<?php while ( have_posts() ) : the_post(); ?>

<?php /* How to display posts */ ?>


				<div class="post" id="post-<?php the_ID(); ?>">
					<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
						<h1><?php the_title(); ?></h1>
					</a>
				
					<small class="author">
						Author: <?php the_author_link() ?> | Date: <span class="date"><?php the_time('F j, Y'); ?></span> | 
						Published in: <?php the_category(', '); ?>
					</small>
				
					<div class="entry">
						<?php the_content('', 'FALSE', ''); ?>
					</div>
				</div><br/>

				<div>
					<?php comments_template(); ?>
				</div><!-- .entry-content -->
<?php endwhile; // End the loop. ?>

<?php /* Display navigation to next/previous pages when applicable */ ?>
				<div id="nav-below" class="navigation">
					<?php posts_nav_link(); ?>
				</div><!-- #nav-below -->

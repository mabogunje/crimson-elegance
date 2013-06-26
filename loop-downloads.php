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
		<h2 class="entry-title"><?php _e( 'No Downloads Available', 'crimson-elegance' ); ?></h2>
		<div class="entry-content">
			<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'crimson-elegance' ); ?></p>
		</div><!-- .entry-content -->
	</div><!-- #post-0 -->
<?php endif; ?>

<?php /* Start the Loop. */ ?>
<?php while ( have_posts() ) : the_post(); ?>

                    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<ul class="attachments">

<?php /* Display attachments only */ ?>
<?php $downloads = &get_children('post_parent=' . get_the_ID() . '&post_type=attachment'); ?>
<?php if( empty($downloads) ) : _e(''); else : ?>
<?php foreach($downloads as $dl) : ?>
                            <li> 
                                <div>
                                    <a class="download" title="Download" href="<?php echo wp_get_attachment_url($dl->ID); ?>">
                                        <img src="<?php bloginfo('template_url') ?>/images/download.png" />
                                    </a>
								    <h2><?php echo $dl->post_title; ?></h2>
								    <small>Posted on  <span class="date"> <?php the_time('l, F jS, Y'); ?></span></small>
                                </div>
							</li><!-- .entry-content -->
<?php endforeach; ?>
						</ul>
                    </div>
<?php endif; ?>
<?php endwhile; // End the loop. ?>

<?php /* Display navigation to next/previous pages when applicable */ ?>
				<div id="nav-below" class="navigation">
					<?php posts_nav_link(); ?>
				</div><!-- #nav-below -->

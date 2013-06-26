<?php /* Template Name: Centered Page */ ?>
<?php 
	wp_get_current_user();
	get_header(); 
?>

	<div id="container">
		<div id="content">		
			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<h1 class="entry-title"><?php the_title(); ?></h1>

					<div class="entry-content">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'twentyten' ), 'after' => '</div>' ) ); ?>
					</div>
				</div>
			<?php endwhile; ?>
		</div>
	</div>
	
<?php get_footer(); ?>

<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?><!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'twentyeleven' ), max( $paged, $page ) );

	?></title>

<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />

<?php if(is_page() && !(is_page(array('editions', 'downloads', 'twists')))) : $style = get_stylesheet_directory_uri() . '/page.css'; ?>
<link rel="stylesheet" type="text/css" media="all" href="<?php echo $style; ?>" />
<?php endif; ?>

<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->

<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/custom.js" type="text/javascript"></script>

<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
?>
<?php
	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed">
    <?php get_template_part('topbar'); ?>
	<header id="branding" role="banner">

			<?php
				// Check to see if the header image has been removed
				$header_image = get_header_image();
				if ( $header_image ) :
					// Compatibility with versions of WordPress prior to 3.4.
					if ( function_exists( 'get_custom_header' ) ) {
						// We need to figure out what the minimum width should be for our featured image.
						// This result would be the suggested width if the theme were to implement flexible widths.
						$header_image_width = get_theme_support( 'custom-header', 'width' );
					} else {
						$header_image_width = HEADER_IMAGE_WIDTH;
					}
					?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<?php
					// The header image
					// Check if this is a post or page, if it has a thumbnail, and if it's a big one
					if ( is_singular() && has_post_thumbnail( $post->ID ) &&
							( /* $src, $width, $height */ $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), array( $header_image_width, $header_image_width ) ) ) &&
							$image[1] >= $header_image_width ) :
						// Houston, we have a new header image!
						echo get_the_post_thumbnail( $post->ID, 'post-thumbnail' );
					else :
						// Compatibility with versions of WordPress prior to 3.4.
						if ( function_exists( 'get_custom_header' ) ) {
							$header_image_width  = get_custom_header()->width;
							$header_image_height = get_custom_header()->height;
						} else {
							$header_image_width  = HEADER_IMAGE_WIDTH;
							$header_image_height = HEADER_IMAGE_HEIGHT;
						}
						?>
				<?php endif; // end check for featured image or standard header ?>
			</a>
			<?php endif; // end check for removed header image ?>

			<?php
				// Has the text been hidden?
				if ( 'blank' == get_header_textcolor() ) :
			?>
				<div class="only-search<?php if ( $header_image ) : ?> with-image<?php endif; ?>">
				</div>
			<?php endif; ?>

            <?php if(function_exists('chi_display_header')) : chi_display_header(); else : ?>
                <div>
					<img src="<?php header_image(); ?>" width="<?php echo $header_image_width; ?>" height="<?php echo $header_image_height; ?>" alt="" />
                </div>
            <?php endif; ?>

			<hgroup>
				<h1 id="site-title"><span><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span></h1>
				<h2 id="site-description"><?php bloginfo( 'description' ); ?></h2>
			</hgroup>

            <!-- Social Media -->
            <span id="bookmark">&nbsp;</span>
            <a href="http://www.facebook.com/redstring.blog/" id="facebook">&nbsp;</a>
            <a href="http://www.twitter.com/redstringblog/" id="twitter">&nbsp;</a>

            <?php

                // Get Most Recent Category Details 
                $recent_cat = get_recent_cat(); 
                $cID = $recent_cat->cat_ID; 
                $cname = $recent_cat->name; 
                $cblurb = category_description($recent_cat->cat_ID); 
                $clength = strlen($cblurb);
                $ctruncate = 250;

                // Get Most Recent Sticky
                $stickies = get_option( 'sticky_posts' );
                rsort($stickies);
                $sticky = $stickies[0];
                $sID = $sname = $sblurb = "";
                
                if ( $stickies[0] )
                {
                    $sID = $stickies[0];
                    $sticky = get_post($sID);

                    $sname = $sticky->post_title;
                    $sblurb = apply_filters('the_content', $sticky->post_content); // Must be very short
                }

            ?>

            <!-- Latest Sticky -->
            <?php if($sticky) : ?>
            <div id="notice" class="sticky">
                <span class="thumbtack">&nbsp;</span>
                <h3><?php echo $sname; ?></h3>
                <p><?php echo $sblurb; ?></p>
            </div>
            <?php endif; ?>
                
            <!-- Latest Category -->
            <div id="skiptolatest"> 
                <h3><?php echo $cname; ?></h3>
                <p>
                    <?php _e(trim(substr($cblurb, 0, $ctruncate))); ?>
                    <?php if($clength > $ctruncate) { echo '...'; } ?>
                </p>
                <a href="<?php echo get_category_link($cID); ?>">Read Current Edition</a>
            </div>
	</header><!-- #branding -->


	<div id="main">

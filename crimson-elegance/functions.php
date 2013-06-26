<?php

// THEME FUNCTIONS
if ( function_exists('register_sidebar') )
{
    register_sidebar( array('name'=>'topbar', 
							'before_widget' => '<div class="widget">',
 							'after_widget' => '</div>',
 							'before_title' => '<dt>',
 							'after_title' => '</dt>')
 					);
	 	
    register_sidebar( array('name'=>'sidebar', 
							'before_widget' => '<div class="widget">',
 							'after_widget' => '</div><p></p>',
 							'before_title' => '<dt>',
 							'after_title' => '</dt>')
 					);
 	
    register_sidebar( array('name'=>'bottombar', 
							'before_widget' => '<div id="%1$s" class="widget %2$s">',
 							'after_widget' => '</div>',
 							'before_title' => '<dt>',
 							'after_title' => '</dt>')
 					);
 					
     register_sidebar( array('name'=>'frontpage-menu', 
							'before_widget' => '',
 							'after_widget' => '',
 							'before_title' => '<dt>',
 							'after_title' => '</dt>')
 					);
}

function trs_comment($comment, $args, $depth)
{
	$GLOBALS['comment'] = $comment; ?>
	<div <?php comment_class(); ?>>
		<div class="comment-author">
 			<span class="author"><?php printf(__('%s says: '), get_comment_author_link()) ?></span>
		</div>

		<?php if ($comment->comment_approved == '0') : ?>
			<em><?php _e('Your comment is awaiting moderation.') ?></em><br />
		<?php endif; ?>
 
		<?php comment_text() ?>
 
		<div class="reply">
			<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
		</div>
	</div>
<?php
}


function trs_comment_form()
{
	$args = array('comment_notes_before' => '<dfn class="comment_notes">' . 
					__('Your email is <em>never</em> published nor shared.') .
					($req ? 'Required fields are highlighted in <em>red</em>' : '') .
					'</dfn>',
	      	       'title_reply' => 'Leave a Comment',
	               'title_reply_to' => 'Leave a Comment for %s',
                   'comment_field' => '<textarea id="comment" name="comment" style="width:100%; height:10em;" aria-required="true"></textarea>',
	               'label_submit' => 'Comment'
	     	     );

	return comment_form($args);
}

/*
function custom_login() 
{ 
	echo '<link rel="stylesheet" type="text/css" href="'.get_bloginfo('template_directory').'/custom-login/custom-login.css" />'; 
}
*/

if ( ! function_exists( 'twentyeleven_content_nav' ) ) :
/**
 * Display navigation to next/previous pages when applicable
 */
function trs_content_nav( $html_id ) {
	global $wp_query;

	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav id="<?php echo esc_attr( $html_id ); ?>">
			<h3 class="assistive-text"><?php _e( 'Post navigation', 'crimson-elegance' ); ?></h3>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'crimson-elegance' ) ); ?></div>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'crimson-elegance' ) ); ?></div>
		</nav><!-- #nav-above -->
	<?php endif;
}
endif; // twentyeleven_content_nav


// HELPER FUNCTIONS

/**
 * Tests if any of a post's assigned categories are descendants of target categories
 *
 * @param int|array $cats The target categories. Integer ID or array of integer IDs
 * @param int|object $_post The post. Omit to test the current post in the Loop or main query
 * @return bool True if at least 1 of the post's categories is a descendant of any of the target categories
 * @see get_term_by() You can get a category by name or slug, then pass ID to this function
 * @uses get_term_children() Passes $cats
 * @uses in_category() Passes $_post (can be empty)
 * @version 2.7
 * @link http://codex.wordpress.org/Function_Reference/in_category#Testing_if_a_post_is_in_a_descendant_category
 */
function in_descendant_category( $cats, $_post = null )
{
	foreach ( (array) $cats as $cat ) {
		// get_term_children() accepts integer ID only
		$descendants = get_term_children( (int) $cat, 'category');
		if ( $descendants && in_category( $descendants, $_post ) )
			return true;
	}
	return false;
}

function get_recent_downloads()
{
    $args = 'post_type=attachment&orderby=date&&post_status=null&post_parent=null';
    $format = '<li>%s</li>';
    $cat = get_cat_id('downloads');

    $is_download = create_function('$attachment', 'return in_descendant_category(' . $cat . ', $attachment->post_parent);'); 

    $attachments = get_posts($args);

    $downloads = array_filter($attachments, $is_download); // Get only attachments in the downloads category
    $downloads = array_splice($downloads, 0, count($downloads)); // Get only most recent download

    if( !empty($downloads) )
    {
        foreach($downloads as $link)
        {
            echo sprintf($format, wp_get_attachment_link($link->ID));
        }
    }
    else
    {
        _e('No new downloads','crimson-elegance');
    }
}

function get_cat_slug($cat)
{
    $cat = (int) $cat;
    $category = get_category($cat);

    return $category->slug;
}

/**
* Returns the most recently created leaf category i.e highest depth category
* Only works if posts are not assigned to multiple categories (:: KLUDGE ::)
 *
 * @uses get_categories() You can get an array of category objects by passing query parameters
 * @uses get_posts() You can get an array of post objects by passing query parameters
 * @uses get_category() Get a category object by passing the category ID
 */
function get_recent_cat()
{
    $cargs = array("orderby" => "id",
                   "order" => "desc"
                  );

    $pargs = array("numberposts" => 1,
                   "order" => "desc",
                   "orderby" => "post_date"
                  );

    $categories = get_categories($args); // Get all categories in order of their creation
    $created = array();
    $parents = array();

    foreach($categories as $category)
    {
        $pargs["category"] = $category->cat_ID;

        $posts = get_posts($pargs); // Get all posts of sub-categories in order of their creation
        
        // Save the most recent post's created date, as well as the IDs of its categories
        $created[] = strtotime($posts[0]->post_date); 
        $parents = array_merge($parents, wp_get_post_categories($posts[0]->ID));
    }

    $parents = array_map("get_category", $parents);
    
    $cats_by_date = array_combine($created, $parents);
    asort($cats_by_date); // IMPORTANT: asort preserves keys-value mappings so we can still access categories by date

    return end($cats_by_date);
}

add_action('login_head', 'custom_login');
?>

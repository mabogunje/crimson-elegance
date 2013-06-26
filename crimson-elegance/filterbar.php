<?php
/**
 * The post-filteration bar at the top of the content area.
 *
 * @package WordPress
 * @subpackage Crimson Elegance
 * @since Crimson Elegance 3.0
 */
?>

            <div id="filter">
                <div class="older">
                    &nbsp;
                    <?php if( $wp_query->max_num_pages > 1 ) { next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'crimson-elegance' ) ); } ?>
                </div>

                <div class="main">
<?php if(is_home() || is_page()) : $categories = get_categories(sprintf('parent=0&exclude=%d,%d', get_cat_id('editions'),  get_cat_id('downloads'))); ?>
                Filter:  
                <ul>
    <?php if(is_page('editions')) : $categories = get_categories(sprintf("hide_empty=0&order_by=id&parent=%d", get_cat_id('editions'))); ?>
                    <li class="selected">All Editions</li>
    <?php elseif(is_page('downloads')) : $categories = get_categories(sprintf("hide_empty=0&order_by=id&parent=%d", get_cat_id('downloads'))); ?>
                    <li class="selected">All Downloads</li>
    <?php elseif(is_page('twists')) : $categories = get_categories(sprintf("hide_empty=0&order_by=id&parent=%d", get_cat_id('twists'))); ?>
                    <li class="selected">All Twists</li>
    <?php else : ?>
                    <li class="selected">Articles</li>
                    <li title="<?php echo get_recent_cat()->slug; ?>">Edition</li>
    <?php endif; ?>
    <?php foreach($categories as $item) :  ?>
                    <li title="<?php echo $item->slug; ?>"><?php echo $item->name; ?></li>
    <?php endforeach; ?>

<?php elseif(is_category() || is_tag()) : ?>
                Currently Showing <?php if(is_tag()) : ?>  Posts Tagged <?php endif; ?>:
                <ul>
                    <li class="selected"><?php echo single_cat_title(); ?></li>

<?php elseif(is_author()) : $curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author)); ?>
                Currently Showing Posts By:
                <ul>
                <li class="selected"><?php echo $curauth->display_name; ?></li>

<?php elseif(is_archive()) : ?>
                Currently Showing Archive For:
                <ul>
    <?php if(is_day()) : ?>
                    <li class="selected"><?php the_time('M d Y'); ?></li>
    <?php elseif(is_month()) : ?>
                    <li class="selected"><?php the_time('F Y'); ?></li>
    <?php elseif(is_year()) : ?>
                    <li class="selected"><?php the_time('Y'); ?></li>
    <?php endif; ?>

<?php elseif(is_single()) : $categories = get_the_category(); ?>
                Return To:
                <ul>
    <?php foreach($categories as $item) : ?>
                    <li><a href="<?php echo get_category_link($item->cat_ID); ?>"><?php echo $item->cat_name; ?></a></li>
    <?php endforeach; ?>

<?php else : ?>
                Go  
                <ul>
                <li><a href="<?php echo home_url(); ?>">Back</a> </li>
<?php endif; ?>
                </ul>
                </div>

                <div class="newer">
                    &nbsp;
                    <?php if( $wp_query->max_num_pages > 1 ) { previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'crimson-elegance' ) ); } ?>
                </div>
            </div>

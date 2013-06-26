<?php
/**
 * The widget-enabled bar at the top of the site.
 *
 * @package WordPress
 * @subpackage Crimson Elegance
 * @since Crimson Elegance 1.0
 */
?>

<dl id="topbar">
	<div class="widget-area">
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('topbar') ) : ?>
        <div class="widget">
            <?php get_search_form(); ?>
        </div>
        <div class="widget">
            <ul><?php wp_list_pages('title_li=&exclude=2,11,85,86,87&sort_column=menu_order'); ?></ul>
        </div>
<?php endif; ?>
	</div>
	
    <div class="login">
        <span>
            <img src="<?php bloginfo('template_directory'); ?>/images/user.png" align="absmiddle"/>
            <?php if(is_user_logged_in()) { echo wp_get_current_user()->display_name; } ?>
            <img src="<?php bloginfo('template_directory'); ?>/images/arrow_down.png" />
        </span>
        <div class="usermenu">
<?php if(is_user_logged_in()) : ?>
            <ul>
                <li><a href="<?php echo admin_url(); ?>">Dashboard</a></li>
                <li><a href="<?php echo admin_url(); ?>/profile.php">Profile</a></li>
                <li><a href="<?php echo wp_logout_url( get_permalink() ); ?>">Logout</a></li>
            </ul>
<?php else : ?>
<form name="loginform" id="loginform" action="<?php echo wp_login_url( get_permalink() ); ?>" method="post">
                <p><input type="text" name="log" id="user_login" value="Username"/></p>
                <p><input type="password" name="pwd" id="user_pass" value="Password"/></p>
                <p><input type="submit" name="wp-submit" id="wp-submit" value="Log In" /></p>
            </form>
<?php endif; ?>
        </div>
	</div>
</dl>

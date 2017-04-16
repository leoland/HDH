<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Hunter_Douglas_Hospitality
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"  >

    <link href="<?php echo get_stylesheet_directory_uri() . '/flexnav/css/flexnav.css'; ?>" rel="stylesheet"
          type="text/css">
    <link href="<?php echo get_stylesheet_directory_uri();?>/css/mTab-style.css" rel="stylesheet">

    <link rel="profile" href="http://gmpg.org/xfn/11">


	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div class="site-wrap">
<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'hdh' ); ?></a>

    <header id="masthead" class="site-header" role="banner">
        <div class="site-branding">

            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                <img class="site-logo logo-1"
                     src="<?php echo get_stylesheet_directory_uri() . '/images/hdh-logo-full.png'; ?>"
                     alt="<?php bloginfo( 'name' ); ?>">
                <img class="site-logo logo-2"
                     src="<?php echo get_stylesheet_directory_uri() . '/images/hdh-logo-negative-full.png'; ?>"
                     alt="<?php bloginfo( 'name' ); ?>">
            </a>

        </div><!-- .site-branding -->
        <div class="menu-button">Menu</div>
        <nav id="mobile-navigation" class="mobile-nav" role="navigation">
            <ul data-breakpoint="801" class="flexnav">

<?php wp_nav_menu(array('theme_location' => 'primary', 'items_wrap' => '%3$s', 'container'=> ''));?>
<?php wp_nav_menu(array('theme_location' => 'secondary','items_wrap' => '%3$s', 'container'=> ''));?>
<?php// create_menu('primary'); ?>

<li>
	<?php get_search_form(); ?></li>
                    </ul>
        </nav>
        <nav id="site-navigation" class="main-navigation" role="navigation">
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
        </nav><!-- #site-navigation -->
        <nav id="secondary-navigation" class="secondary-navigation" role="navigation">
            <button class="search-toggle"></button>
			<?php wp_nav_menu( array( 'theme_location' => 'secondary', 'menu_id' => 'secondary-menu' ) ); ?>
        </nav><!-- #site-navigation -->
        <a href="#"><span class="sales-rep-link">Find a Sales Rep</span></a>
        <div class="dt-search"><?php get_search_form(); ?><button class="dt-search-close"></button></div>
    </header><!-- #masthead -->

    <div id="content" class="site-content">

<?php
/**
 * The header for our theme.
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package sosimple-child
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'sosimple-child' ); ?></a>

    <header id="masthead" class="site-header" role="banner">
        <div class="site-branding">
            <?php if ( function_exists( 'jetpack_the_site_logo' ) ) jetpack_the_site_logo(); ?>
            <div class="header-side left">
                <ul class="header-side-top">
                    <li class="header-side-item">
                        Danielle Lewandowski
                    </li>
                </ul>
                <ul class="header-side-bottom">
                    <li class="header-side-item">
                        bitbucket
                    </li>
                </ul>
            </div>
                <hgroup>
                    <?php if ( get_theme_mod( 'sosimple_logo' ) ) : ?>
                    <div class='site-logo'>
                        <a href='<?php echo esc_url( home_url( '/' ) ); ?>' title='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' rel='home'><img src='<?php echo esc_url( get_theme_mod( 'sosimple_logo' ) ); ?>' alt='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>'></a>
                    </div>
                    <?php else : ?>
                        <a href='<?php echo esc_url( home_url( '/' ) ); ?>' title='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' rel='home'>
                            <img class='navatar' src='/wp-includes/images/dani_avatar.jpg'/>
                        </a>
                    <!--<h1 class='site-title'><a href='<?php echo esc_url( home_url( '/' ) ); ?>' title='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' rel='home'><?php bloginfo( 'name' ); ?></a></h1>-->
                    <h2 class='site-description'><?php bloginfo( 'description' ); ?></h2>
                </hgroup>
                <div class="header-side right">
                    <ul class="header-side-top">
                        <li class="header-side-item">
                            Web Developer
                        </li>
                    </ul>
                    <ul class="header-side-bottom">
                        <li class="header-side-item">
                            facebook
                        </li>
                    </ul>
                </div>
            <?php endif; ?>
        </div><!-- .site-branding -->

        <nav id="site-navigation" class="main-navigation" role="navigation">
            <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'sosimple' ); ?></button>
            <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
        </nav><!-- #site-navigation -->
    </header><!-- #masthead -->

    <div id="content" class="site-content">

<!DOCTYPE html>

<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html id="ie7" class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html id="ie8" class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><html class="no-js" <?php language_attributes(); ?>> <![endif]-->

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    
    <!-- Set the viewport width to device width for mobile -->
    <meta name="viewport" content="width=device-width" />
    
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
    echo ' | ' . sprintf( __( 'Page %s', 'smart_foundation' ), max( $paged, $page ) ); ?>
    </title>
    
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon.ico">
    <!-- IE Fix for HTML5 Tags -->
    <!--[if lt IE 9]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/ie8-grid.css" />
    <![endif]-->
    <?php // Checking user agent to apply font aliasing for windows
    if (strpos($_SERVER['HTTP_USER_AGENT'], "Windows", 0) !== FALSE) { ?>
    <link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri() . '/css/windows_aliasing.css'; ?>" />
    <?php } ?>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    
    <div class="contain-to-grid fixed hide-for-medium-up">
        <nav class="top-bar" data-topbar>
            <ul class="title-area">
                <li class="name">
                    <h1>
                        <a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a>
                    </h1>
                </li>          

                <?php if( has_nav_menu( 'main-menu' ) ){ ?><li class="toggle-topbar menu-icon"><a href="#"><span><?php _e('Menu', 'smart_foundation'); ?></span></a></li> <?php } ?>

            </ul>
            <section class="top-bar-section">
                <?php foundation_top_bar(); ?>
            </section>
        </nav>
    </div>

    <div id="page" class="row">
        <div id="inner-page" class="large-12 columns">
            <header id="site-header" class="row show-for-medium-up">
                <div class="large-12 columns">
                    <div id="logos" class="row">
                        <div id="site-title" class="large-12 columns">
                            <h1>
                                <a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
                                    <?php  echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>
                                </a>
                            </h1>
                            <?php echo esc_attr( get_bloginfo( 'description', 'display' ) ); ?>
                        </div>
                    </div>
                </div>            
            </header>
            
            <div id="site-banner" class="row">
                <img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="<?php _e('Banner', 'smart_foundation'); ?>" />  
            </div>          
            
            <nav class="main-navigation row show-for-medium-up" role="navigation">
                <?php 
                    if( has_nav_menu( 'main-menu' )){
                        $menu_class = 'menu large-12 columns';
                    }else{
                        $menu_class = 'menu-hovedmeny-container';
                    }
                    wp_nav_menu( 
                        array(
                            'theme_location'    => 'main-menu', 
                            'menu'              => 'Meny', 
                            'menu_class'        => $menu_class )); ?>
            </nav>
            
            <div id="main" class="row">
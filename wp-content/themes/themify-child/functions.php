<?php

    add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

    function theme_enqueue_styles() {

        $parent_style = 'parent-style';

        wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
        wp_enqueue_style( 'child-style',
            get_stylesheet_directory_uri() . '/style.css',
            array( $parent_style )
        );
    }
    add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );


    function wpsites_exclude_latest_post($query) {
        if ($query->is_home() && $query->is_main_query()) {
            $query->set( 'offset', '1' );
        }
    }

    add_action('pre_get_posts', 'wpsites_exclude_latest_post');
?>
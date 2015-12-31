<?php
/**
 * More Tag settings
 *
 */

if ( ! function_exists( 'more_link' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 */

function more_link() {

    $sosimple_options = get_option( 'sosimple_option_name' ); // Array of All Options
    $excerpt_type_0 = $sosimple_options['excerpt_type_0']; // Excerpt Type
    $read_more_type_1 = $sosimple_options['read_more_type_1']; // Read More Type
    $read_more_button_style_2 = $sosimple_options['read_more_button_style_2']; // Read More Button Style
    $read_more_button_icon_3 = $sosimple_options['read_more_button_icon_3']; // Read More Button Icon
    $read_more_text_4 = $sosimple_options['read_more_text_4']; // Read More Text
    $button_background_color_5 = $sosimple_options['button_background_color_5']; // Button Background Color
    
    //Option-one
    //Option-second
    //Option-third
    //Option-fourth

    // Excerpt Type
    if ( ($excerpt_type_0 == 'Option-second') || (!$excerpt_type_0)){
        the_excerpt();
    }
    else{
        // Read More Type
        if ( ($read_more_type_1 == 'Option-one') || (!$read_more_type_1) ) {
           the_content('',FALSE,'');
        }
        elseif( $read_more_type_1 == 'Option-second' )  {

            if ( $read_more_text_4 ) {
                the_content($read_more_text_4);
            }
            else{
                the_content('');
            }
           
        }

        elseif( $read_more_type_1 == 'Option-third' ){

            if ( $read_more_text_4 ) {

                if ($read_more_button_style_2 == 'Option-one'){
                    the_content("<span class='ss_button ss_fill ss_squared'>".$read_more_text_4."</span>");
                }
                else{
                    the_content("<span class='ss_button ss_fill ss_rounded'>".$read_more_text_4."</span>");
                }
            }
            else{
                the_content('');
            }
           
        }

        elseif( $read_more_type_1 == 'Option-fourth' ){

            $icon = more_link_icon();

            if ( $read_more_text_4 ) {

                if ($read_more_button_style_2 == 'Option-one'){
                    the_content("<span class='ss_button ss_fill ss_squared ss_icon ss_icon_$icon'>".$read_more_text_4."</span>");
                }
                else{
                    the_content("<span class='ss_button ss_fill ss_rounded ss_icon ss_icon_$icon'>".$read_more_text_4."</span>");
                }
            }
            else{
                the_content('');
            }
           
        }
    }

}
endif;

if ( ! function_exists( 'more_link_icon' ) ) :
function more_link_icon() {

    $sosimple_options = get_option( 'sosimple_option_name' ); // Array of All Options
    $read_more_button_icon_3 = $sosimple_options['read_more_button_icon_3']; // Read More Button Icon
    

    if (($read_more_button_icon_3 == 'Option-one') || (!$read_more_button_icon_3)) {
        $icon = 'arrow';
    }
    elseif ($read_more_button_icon_3 == 'Option-second'){
        $icon = 'arrow2';
    }
    elseif ($read_more_button_icon_3 == 'Option-third'){
        $icon = 'check';
    }

    return $icon;

}
endif;

// Replaces the excerpt "more" text by a link
function new_excerpt_more() {
    global $post;
    return '<a class="moretag" href="'. get_permalink($post->ID) . '"> ...</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');

?>
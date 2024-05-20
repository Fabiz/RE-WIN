<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if ( !function_exists( 'chld_thm_cfg_locale_css' ) ):
    function chld_thm_cfg_locale_css( $uri ){
        if ( empty( $uri ) && is_rtl() && file_exists( get_template_directory() . '/rtl.css' ) )
            $uri = get_template_directory_uri() . '/rtl.css';
        return $uri;
    }
endif;
add_filter( 'locale_stylesheet_uri', 'chld_thm_cfg_locale_css' );


/*================================================ 
# Load custom Blog Module. added by fso. see https://intercom.help/elegantthemes/en/articles/4532734-moving-blog-module-in-child-theme
================================================*/ 

// register TransportList
add_action(
    'et_builder_ready',
    function() {
        get_template_part( '/includes/RewinTransportList' ); 
        $dcfm = new ET_Builder_Module_Rewin_Transport_List(); 
        add_shortcode( 'et_pb_rewin_transport_list', array( $dcfm, '_shortcode_callback' ) ); 
    }
);

// register PressList
add_action(
    'et_builder_ready',
    function() {
        get_template_part( '/includes/RewinPressList' ); 
        $dcfm = new ET_Builder_Module_Rewin_Press_List(); 
        add_shortcode( 'et_pb_rewin_press_list', array( $dcfm, '_shortcode_callback' ) ); 
    }
);



// END ENQUEUE PARENT ACTION

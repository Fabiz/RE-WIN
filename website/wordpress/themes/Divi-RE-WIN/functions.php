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

// register TransportBlog
add_action(
    'et_builder_ready',
    function() {
        get_template_part( '/includes/TransportBlog' ); 
        $dcfm = new ET_Builder_Module_Transport_Blog(); 
        add_shortcode( 'et_pb_transport_blog', array( $dcfm, '_shortcode_callback' ) ); 
    }
);


// change sort order of transports
add_action(
    'pre_get_posts', 
    function($query) {
        $pac = get_query_var( 'post_type' );
        $category = get_query_var('category_name');
            
        if ( 'post' == $pac && 'transport' == $category )
        {
            $query->set('orderby', 'date');
            $query->set('order', 'DESC');
        }
    }
);


// END ENQUEUE PARENT ACTION

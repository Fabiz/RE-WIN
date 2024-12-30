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

// register TeamList
add_action(
    'et_builder_ready',
    function() {
        get_template_part( '/includes/RewinTeamList' ); 
        $dcfm = new ET_Builder_Module_Rewin_Team_List(); 
        add_shortcode( 'et_pb_rewin_team_list', array( $dcfm, '_shortcode_callback' ) ); 
    }
);

// register EventsList

add_action(
   'et_builder_ready',
   function() {
       get_template_part( '/includes/RewinEventList' ); 
       $dcfm = new ET_Builder_Module_Rewin_Event_List(); 
       add_shortcode( 'et_pb_rewin_event_list', array( $dcfm, '_shortcode_callback' ) ); 
   }
);

add_action(
    'et_builder_ready',
    function() {
        get_template_part( '/includes/RewinEventHeader' ); 
        $dcfm = new ET_Builder_Module_Rewin_Event_Header(); 
        add_shortcode( 'et_pb_rewin_event_header', array( $dcfm, '_shortcode_callback' ) ); 
    }
 );


// Function add Custom // ERLAUBE SVG UPLOADS 
// ========================================================================== //
function bh_svgimg_types($file_types){

   $new_filetypes = array();
   $new_filetypes['svg'] = 'image/svg+xml';
   $file_types = array_merge($file_types, $new_filetypes );

   return $file_types;
}
add_action('upload_mimes', 'bh_svgimg_types');

// Zeigt SVG's in der Mediathek als Vorschau an // 
function bh_svg_media_thumbnails($response, $attachment, $meta){
    if($response['type'] === 'image' && $response['subtype'] === 'svg+xml' && class_exists('SimpleXMLElement'))
    {
        try {
            $path = get_attached_file($attachment->ID);
            if(@file_exists($path))
            {
                $svg = new SimpleXMLElement(@file_get_contents($path));
                $src = $response['url'];
                $width = (int) $svg['width'];
                $height = (int) $svg['height'];

                //Media Gallerie
                $response['image'] = compact( 'src', 'width', 'height' );
                $response['thumb'] = compact( 'src', 'width', 'height' );

                //Media Einzelbild
                $response['sizes']['full'] = array(
                    'height'        => $height,
                    'width'         => $width,
                    'url'           => $src,
                    'orientation'   => $height > $width ? 'portrait' : 'landscape',
                );
            }
        }
        catch(Exception $e){}
    }

    return $response;
}
add_filter('wp_prepare_attachment_for_js', 'bh_svg_media_thumbnails', 10, 3);




// END ENQUEUE PARENT ACTION

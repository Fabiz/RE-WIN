<?php

class ET_Builder_Module_Rewin_Team_List extends ET_Builder_Module {

			
	public $slug       = 'et_pb_rewin_team_list';
	public $vb_support = 'off';

	public $main_css_element = '%%order_class%% .et_pb_post';


	public function init() {
		$this->name = esc_html__( 'ReWin Team List', 'et_builder' );
	}

	public function get_fields() {
		return array(
			'heading'     => array(
				'label'           => esc_html__( 'Heading', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Input your desired heading here.', 'et_builder' ),
				'toggle_slug'     => 'main_content',
			)
		);
	}

	public function render( $unprocessed_props, $content, $render_slug ) {
		return sprintf(
			//'<div class="page-list-items team-list"><h1 class="rewin-team-list-header-heading">%1$s</h1>
			//<p>%2$s</p></div>',
			'%2$s',
			esc_html( $this->props['heading'] ),
			$this->tablecontent()
		);
	}

  private function tablecontent() {
		ob_start(); ?>

		<?php 
			$args = array( 
				'posts_per_page' => 100,
				'post_status'    => array( 'publish', 'private', 'inherit' ),
				'category_name'  => 'team', 
				'orderby'        => 'meta_value', 
				'meta_key'       => 'name', 
				'order'          => 'ASC'); 


			$posts_query = new WP_Query( $args );
			$count = 0;
			while($posts_query->have_posts()) : 
				$posts_query->the_post();
			
				if ($count % 4 == 0) {
					echo '<div class="et_pb_row team-row et_pb_row_4col">';
				}
	
			// 	<div class="et_pb_team_member_image et-waypoint et_pb_animation_off et-animated"><img fetchpriority="high" decoding="async" width="300" height="300" src="https://re-win.ch/wordpress/wp-content/uploads/2023/05/Medine-Altiok-1.jpg" alt="Medine Altiok" srcset="https://re-win.ch/wordpress/wp-content/uploads/2023/05/Medine-Altiok-1.jpg 300w, https://re-win.ch/wordpress/wp-content/uploads/2023/05/Medine-Altiok-1-150x150.jpg 150w" sizes="(max-width: 300px) 100vw, 300px" class="wp-image-14189"></div>
			// 	<div class="et_pb_team_member_description">
			// 		<h4 class="et_pb_module_header">Medine Altiok</h4>
			// 		<p class="et_pb_member_position">RE-WIN Vorstand: Finanzen</p>
			// 		<div><p><span>Architektin </span><span class="ContentPasted1"></span><span>AA&nbsp;</span><span class="ContentPasted2">Dipl.</span></p></div>
			// 		<ul class="et_pb_member_social_links"><li><a href="https://www.linkedin.com/in/medinealtiok/" class="et_pb_font_icon et_pb_linkedin_icon"><span>LinkedIn</span></a></li></ul>
			// 	</div>
			// </div>
			// </div>

				echo '<div class="et_pb_column et_pb_column_1_4 et_pb_css_mix_blend_mode_passthrough">';
				
				echo '<div class="et_pb_module et_pb_team_member clearfix  et_pb_bg_layout_light">';
		
		
				{

					$image = get_field('portrait');
					// (size: thumbnail, medium, large, full or custom size)
					if( $image ) {
						 echo '<div class="et_pb_team_member_image team-portrait et-waypoint et_pb_animation_off et-animated">';
						 
						 echo '<img loading="lazy" decoding="async" width="300" height="300" src="';
						 echo $image;
						 echo '"/>';

						 echo '</div>';
					}

				//	echo sprintf(
				//		'<div class="et_pb_team_member_image et-waypoint et_pb_animation_off et-animated"><img fetchpriority="high" decoding="async" width="300" height="300" src="https://re-win.ch/wordpress/wp-content/uploads/2023/05/Medine-Altiok-1.jpg" alt="Medine Altiok" srcset="https://re-win.ch/wordpress/wp-content/uploads/2023/05/Medine-Altiok-1.jpg 300w, https://re-win.ch/wordpress/wp-content/uploads/2023/05/Medine-Altiok-1-150x150.jpg 150w" sizes="(max-width: 300px) 100vw, 300px" class="wp-image-14189"></div>',
			// '%2$s'
				//	);
					// 
					echo '<div class="et_pb_team_member_description">';
					echo '<h4 class="et_pb_module_header">';
					
					$acf_field = get_field('forename');
					if ($acf_field) { 
					  echo $acf_field;
					}
				  echo ' ';
					$acf_field = get_field('name');
					if ($acf_field) { 
					  echo $acf_field;
					}
					echo '</h4>';

					echo '<p class="et_pb_member_position">';
					$acf_field = get_field('function');
					if ($acf_field) { 
					  echo $acf_field;
					}
					echo '</p>';

					echo '<p class="et_pb_member_job_title">';
					$acf_field = get_field('jobtitle');
					if ($acf_field) { 
					  echo $acf_field;
					}
					echo '</p>';

					$acf_field = get_field('linkedin');
					if ($acf_field) { 
						printf('<ul class="et_pb_member_social_links"><li><a href="%1$s" class="et_pb_font_icon et_pb_linkedin_icon"><span>LinkedIn</span></a></li></ul>', $acf_field);
					}					

					echo '</div>';


				

				

				}
			
				echo '</div>'; // finish et_pb_module
			
				echo '</div>'; // finish et_pb_column
			
				if ($count % 4 == 3) {
					echo '</div>'; // finish row
				}
				
				$count += 1;
			
			endwhile;

			echo '</div>';

		
		return ob_get_clean();
	}

}

new ET_Builder_Module_Rewin_Team_List();


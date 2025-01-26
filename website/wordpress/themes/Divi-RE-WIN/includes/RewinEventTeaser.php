<?php

class ET_Builder_Module_Rewin_Event_Teaser extends ET_Builder_Module {

			
	public $slug       = 'et_pb_rewin_event_teaser';
	public $vb_support = 'off';

	public $main_css_element = '%%order_class%% .et_pb_post';


	public function init() {
		$this->name = esc_html__( 'ReWin Event Teaser', 'et_builder' );
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
			'<div class="page-list-items event-teaser">
			<p>%2$s</p></div>',
			esc_html( $this->props['heading'] ),
			$this->tablecontent()
		);
	}

	private function argscomparedate($compare) {
		$today = date('Ymd');
		return array('posts_per_page' => 3, 
									'category_name' => 'event',
									'meta_key' => 'date',
									'meta_query'  => array( array(
										'key' => 'date', 
										'value' => $today, 
										'compare' => $compare, 
										'type' => 'DATE'
									)),
									'orderby'           => 'meta_value',
									'order'             => 'ASC' 
		);
	}

  private function tablecontent() {
		ob_start(); ?>

		<?php 
	
			$args = $this->argscomparedate('>=');
		

			$posts_query = new WP_Query( $args );
			$count = 0;
			$displayheader = false;

			while($posts_query->have_posts()) : 
				$posts_query->the_post();
			
				if (!$displayheader) {
					echo '<h2 class="rewin-transport-list-header-heading" style="text-align: center;">Kommende Events</h2>';
					$displayheader = true;
					
				}
				if ($count % 3 == 0) {
					echo '<div class="et_pb_row event-row">';
				}
			
				echo '<div class="et_pb_column et_pb_column_1_3 event-cell">';
			
				{
				
					echo '<div class="event-date">';
					$acf_date = get_field('date');
					if ($acf_date) {
							echo '<span class="event-header-value">' . $acf_date . '</span><br/>';
					}
					echo '</div>';

					echo '<a href="' . get_permalink() . '">';
					echo '<div class="event-title"><h5>';
					echo the_title();
					echo '</h5></div>';
					echo '</a>';

				

				}

				echo '</div>'; // end column
			

				if ($count % 4 == 3) {
					echo '</div>';
				}
				
				$count += 1;
			
			endwhile;

			echo '</div>';

		
		return ob_get_clean();
	}

}

new ET_Builder_Module_Rewin_Event_Teaser();


<?php

class ET_Builder_Module_Rewin_Event_List extends ET_Builder_Module {

			
	public $slug       = 'et_pb_rewin_event_list';
	public $vb_support = 'off';

	public $main_css_element = '%%order_class%% .et_pb_post';


	public function init() {
		$this->name = esc_html__( 'ReWin Transport List', 'et_builder' );
	}

	public function get_fields() {
		return array(
			'heading'     => array(
				'label'           => esc_html__( 'Heading', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Input your desired heading here.', 'et_builder' ),
				'toggle_slug'     => 'main_content',
			),
			'events_number'  => array(
				'label'            => esc_html__( 'Event Count', 'et_builder' ),
				'type'             => 'text',
				'option_category'  => 'configuration',
				'description'      => esc_html__( 'Choose how many events you would like to display.', 'et_builder' ),
				'computed_affects' => array(
					'__posts',
				),
				'toggle_slug'      => 'main_content',
				'default'          => 100,
			),
		);
	}

	public function render( $unprocessed_props, $content, $render_slug ) {
		return sprintf(
			'<div class="page-list-items event-list"><h1 class="rewin-event-list-header-heading">%1$s</h1>
			<p>%2$s</p></div>',
			esc_html( $this->props['heading'] ),
			$this->tablecontent()
		);
	}

  private function tablecontent() {
		ob_start(); ?>

		<?php 
			$args = array( 
				'posts_per_page' => intval( $this->props['events_number'] ),
				'post_status'    => array( 'publish', 'private', 'inherit' ),
				'category_name'  => 'event', 
				'orderby'        => 'event_date', 
				'meta_key'       => 'number', 
				'order'          => 'DESC'); 


			$posts_query = new WP_Query( $args );
			$count = 0;
			while($posts_query->have_posts()) : 
				$posts_query->the_post();
			
				if ($count % 4 == 0) {
					echo '<div class="et_pb_row event-row">';
				}
			
				echo '<div class="et_pb_column et_pb_column_1_4 event-cell">';
			
				{
					echo '<div class="event-title"><h4>';
					echo the_title();
					echo '</h4></div>';
					echo '<div class="event-date">';
					echo the_date();
					echo '</div>';

					
					
					echo '</div>';
				}
			

				if ($count % 4 == 3) {
					echo '</div>';
				}
				
				$count += 1;
			
			endwhile;

			echo '</div>';

		
		return ob_get_clean();
	}

}

new ET_Builder_Module_Rewin_Event_List();


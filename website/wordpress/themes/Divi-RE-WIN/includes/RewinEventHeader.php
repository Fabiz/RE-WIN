<?php

class ET_Builder_Module_Rewin_Event_Header extends ET_Builder_Module {

			
	public $slug       = 'et_pb_rewin_event_header';
	public $vb_support = 'off';
	

	public $main_css_element = '%%order_class%% .et_pb_post';


	public function init() {
		$this->name = esc_html__( 'ReWin Event Header', 'et_builder' );
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
			'<div class="page-list-items event-header">
			%2$s</div>',
			esc_html( $this->props['heading'] ),
			$this->tablecontent()
		);
	}

  private function tablecontent() {
		ob_start(); ?>

		<div class="rw-table page-list-items">
    
		<?php 


			$acf_date = get_field('date');
				
			echo '<h1 class="entry-title">';
			echo the_title();
			
			echo '</h1>';

			echo '<div class="event-header">';

			$acf_date = get_field('date');
			if ($acf_date) {
				echo '<span class="event-header-key">Datum:</span><span class="event-header-value">' . $acf_date . '</span><br/>';
			}
			
			$acf_startime = get_field('starttime');
			if ($acf_startime) { 
				echo '<span class="event-header-key">Zeit:</span><span class="event-header-value">' . $acf_startime;
				$acf_endtime = get_field('endtime');
				if ($acf_endtime) { 
					echo '-' . $acf_endtime;
				}
				echo '</span><br/>';
			}
			$acf_location = get_field('location');
			if ($acf_location) {
				echo '<span class="event-header-key">Ort:</span><span class="event-header-value">' . $acf_location . '</span><br/>';
			}
			echo '</div>';

			echo '</div>';

	
		return ob_get_clean();
	}

}

new ET_Builder_Module_Rewin_Event_Header();


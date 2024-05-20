<?php

class ET_Builder_Module_Rewin_Transport_List extends ET_Builder_Module {

			
	public $slug       = 'et_pb_rewin_transport_list';
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
		);
	}

	public function render( $unprocessed_props, $content, $render_slug ) {
		return sprintf(
			'<div class="page-list-items press-list"><h1 class="rewin-press-list-header-heading">%1$s</h1>
			<p>%2$s</p></div>',
			esc_html( $this->props['heading'] ),
			$this->tablecontent()
		);
	}

  private function tablecontent() {
		ob_start(); ?>

		<?php 
			$args = array( 'posts_per_page' => 50, 'category_name' => 'transport', 'orderby' => 'title'); 
			$posts_query = new WP_Query( $args );
			$count = 0;
			while($posts_query->have_posts()) : 
				$posts_query->the_post();
			
				if ($count % 4 == 0) {
					echo '<div class="et_pb_row transport-row">';
				}
			
				echo '<div class="et_pb_column et_pb_column_1_4 transport-cell">';
			
				{
					echo '<div class="transport-title"><h4>';
					echo the_title();
					echo '</h4></div>';
					echo '<div class="transport-date">';
					echo the_date();
					echo '</div>';

					echo '<div class="transport-icon">';
					echo file_get_contents(__DIR__ . '/../images/largetruck.svg');
					echo '</div>';
				
					echo '<div class="transport-from-to">';
					$acf_field = get_field('from');
					if ($acf_field) { 
						echo '<span class="transport-from">';
						echo $acf_field;
						echo  '</span>'; 
					}
					echo ' &rarr; ';
					$acf_field = get_field('to');
					if ($acf_field) { 
						echo '<span class="transport-to">';
						echo  $acf_field;
						echo '</span>'; 
					}
					echo '</div>';

					$acf_field = get_field('cargo');
					if ($acf_field) { 
						echo '<div class="transport-cargo">';
						echo $acf_field;
						echo '</div>'; 
					}
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

new ET_Builder_Module_Rewin_Transport_List();


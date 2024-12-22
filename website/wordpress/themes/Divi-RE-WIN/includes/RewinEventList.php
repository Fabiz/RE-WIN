<?php

class ET_Builder_Module_Rewin_Event_List extends ET_Builder_Module {

			
	public $slug       = 'et_pb_rewin_event_list';
	public $vb_support = 'off';

	public $main_css_element = '%%order_class%% .et_pb_post';


	public function init() {
		$this->name = esc_html__( 'ReWin Event List', 'et_builder' );
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
			'<div class="page-list-items event-list"><h1 class="rewin-event-list-header-heading">%1$s</h1>
			<p>%2$s</p></div>',
			esc_html( $this->props['heading'] ),
			$this->tablecontent()
		);
	}

  private function tablecontent() {
		ob_start(); ?>

		<div class="rw-table page-list-items">
    
		<?php 
			$args = array( 'posts_per_page' => 50, 'category_name' => 'event'); 
			$posts_query = new WP_Query( $args );
			while($posts_query->have_posts()) : 
					$posts_query->the_post();
					?>
			
				<div class="event-row">
					
					<div class="rw-cell-content event-cell event-content">
						<h2 class="entry-title"><?php the_title(); ?></h2>
						<!-- <p class="post-meta"> <span class="published"><?php the_date(); ?></span></p> -->
						<p>
							<?php	
								
								echo '<div class="event-date">';

								$acf_date = get_field('date');
								if ($acf_date) {
									echo 'Datum: ' . $acf_date . '<br/>';
								}
								$acf_startime = get_field('starttime');
								if ($acf_startime) { 
									echo 'Zeit:' . $acf_startime;
									$acf_endtime = get_field('endtime');
									if ($acf_endtime) { 
										echo '-' . $acf_endtime;
									}
									echo '<br/>';
								}
								$acf_location = get_field('location');
								if ($acf_location) {
									echo 'Ort: ' . $acf_location . '<br/>';
								}
							
								echo get_permalink( );

								echo '</div>';
							?>
						</p>

						<?php	
						$value = get_field( "url" );
						if( $value ) {
							echo '<div class="button-link et_pb_button_module_wrapper et_pb_button_10000_wrapper et_pb_module ">';
								echo '<a class="et_pb_button et_pb_button_10000 et_pb_bg_layout_light" href="' . $value . '" target="_blank">Zum Beitrag</a>';
							echo '</div>';
						}
						?>
					</div>
				</div>
			<?php endwhile; ?>
			</div>

		<?php
		return ob_get_clean();
	}

}

new ET_Builder_Module_Rewin_Event_List();


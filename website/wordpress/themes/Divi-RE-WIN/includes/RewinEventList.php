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
			'date_filter'  => array(
				'label'            => esc_html__( 'Date Filter <= / >', 'et_builder' ),
				'type'            => 'select',
				'options'           => array(
						'0' => esc_html__( 'Upcomming', 'foo_translation' ),
						'1'  => esc_html__( 'Past', 'foo_translation' ),
				),
				'option_category'  => 'configuration',
				'description'      => esc_html__( 'Choose how the events should be filtered (<=,>, ...).', 'et_builder' ),
				'computed_affects' => array(
					'__posts',
				),
				'toggle_slug'      => 'main_content',
				'default'          => 1,
			),
		);
	}

	public function render( $unprocessed_props, $content, $render_slug ) {
		return sprintf(
			'<div class="page-list-items event-list">
			%2$s</div>',
			esc_html( $this->props['heading'] ),
			$this->tablecontent()
		);
	}

	private function showEvent( $isupcommingevent)
	{
		?>
		<div class="event-row">
						
			<div class="rw-cell-content event-cell event-content">
				<h4 class="entry-title">
					<?php	
						echo the_title();
					?>
				</h4>
					<?php	
						
						echo '<div class="event-info">';

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
					
						$detailtext = "Details";

						if ($isupcommingevent) {

							$field = get_field_object('subscription');	
							$choices = $field['value'];

							if ($choices && !empty($choices)) {
								if ($choices[0] == 'hassubscription') {

									$detailtext = "Details & Ameldung";
								}
							}
						}

						if (get_field('subscription')) {
							if ( get_field('hassubscription')  ) {
								echo "has";
							}
						}

						$acf_subscription = get_field('hassubscription');
						if ($acf_subscription) {
							$detailtext = $acf_subscription[0];
						}
						
						echo '<div class="button-link et_pb_button_module_wrapper et_pb_button_10000_wrapper et_pb_module ">';
						echo '<a class="et_pb_button et_pb_button_10000 et_pb_bg_layout_light" href="' . get_permalink() . '">' . $detailtext . '</a>';
						echo '</div>';

						echo '</div>';
					?>
			
			</div>
		</div>
		<?php
	}

	private function argscomparedate($compare, $order) {
		$today = date('Ymd');
		return array('posts_per_page' => 50, 
									'category_name' => 'event',
									'meta_key' => 'date',
									'meta_query'  => array( array(
										'key' => 'date', 
										'value' => $today, 
										'compare' => $compare, 
										'type' => 'DATE'
									)),
									'orderby'           => 'meta_value',
									'order'             => $order 
		);
	}

  private function tablecontent() {
		ob_start(); ?>

		<div class="rw-table page-list-items">
    
		<?php 
			$today = date('Ymd');
			$filter = intval($this->props['date_filter']) == 1 ? '>=' : '<';
			$order = intval($this->props['date_filter']) == 1 ? 'ASC' : 'DESC';
	
			$args = $this->argscomparedate($filter, $order);
			
			$posts_query = new WP_Query( $args );
			while($posts_query->have_posts()) : 
					$posts_query->the_post();

					$this->showEvent(intval($this->props['date_filter']));
			
			endwhile;
	
		return ob_get_clean();
	}

}

new ET_Builder_Module_Rewin_Event_List();


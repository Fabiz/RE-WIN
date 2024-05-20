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
			'content'     => array(
				'label'           => esc_html__( 'Content', 'et_builder' ),
				'type'            => 'tiny_mce',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Content entered here will appear below the heading text.', 'et_builder' ),
				'toggle_slug'     => 'main_content',
			),
		);
	}

	public function render( $unprocessed_props, $content, $render_slug ) {
		return sprintf(
			'<h1 class="rewin-transport-list-header-heading">%1$s</h1>
			<p>%2$s</p>',
			esc_html( $this->props['heading'] ),
			$this->props['content']
		);
	}
}

	new ET_Builder_Module_Rewin_Transport_List();


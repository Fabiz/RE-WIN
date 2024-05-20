<?php

class ET_Builder_Module_Rewin_Press_List extends ET_Builder_Module {

			
	public $slug       = 'et_pb_rewin_press_list';
	public $vb_support = 'off';

	public $main_css_element = '%%order_class%% .et_pb_post';


	public function init() {
		$this->name = esc_html__( 'ReWin Press List', 'et_builder' );
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
			'<div class="page-list-items press-list"><h1 class="rewin-press-list-header-heading">%1$s</h1>
			<p>%2$s</p></div>',
			esc_html( $this->props['heading'] ),
			$this->tablecontent()
		);
	}

  private function tablecontent() {
		ob_start(); ?>

		<table>
    
		<?php 
			$args = array( 'posts_per_page' => 50, 'category_name' => 'press'); 
			$posts_query = new WP_Query( $args );
			while($posts_query->have_posts()) : 
					$posts_query->the_post();
					?>
			
				<tr>
					<td>
						<?php
							$image = get_field('icon');
							// (size: thumbnail, medium, large, full or custom size)
							if( $image ) {
								echo wp_get_attachment_image( $image, "medium", "", ["class" => "thumb"] );
							}
						?>
					</td>
					<td>
						<h2 class="entry-title"><?php the_title(); ?></h2>
						<p class="post-meta"> <span class="published"><?php the_date(); ?></span></p>
						<p>
							<?php	
								$value = get_field( "text" );
								if( $value ) {
										echo wp_kses_post( $value );
								} else {
										echo 'Field "text" is not defined';
								}
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
					</td>
					</tr>
			<?php endwhile; ?>
		</table>

		<?php
		return ob_get_clean();
	}

}

new ET_Builder_Module_Rewin_Press_List();


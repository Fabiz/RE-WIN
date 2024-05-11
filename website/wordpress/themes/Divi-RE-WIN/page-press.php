<?php
/*
Template Name: Press Page
*/

get_header(); ?>

<div class="container">
	<div id="content-area" class="clearfix page-press">
		<article class="page type-page status-publish hentry">	


			<h1 class="main_title"><?php the_title(); ?></h1>
			<table>
    
			<?php 
				$args = array( 'posts_per_page' => 50, 'category_name' => 'press'); 
				$posts_query = new WP_Query( $args );
				while($posts_query->have_posts()) : 
						$posts_query->the_post();
						$date = get_the_date(); ?>
				
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
									echo '<a class="et_pb_button et_pb_button_10000 et_pb_bg_layout_light" href="' . $value . '">Zum Beitrag</a>';
								echo '</div>';
							}
							?>
						</td>
						</tr>
				<?php endwhile; ?>
			</table>
		</article>	
	</div>
</div>		
			
			
<?php get_footer(); ?>
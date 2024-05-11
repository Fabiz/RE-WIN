<?php
/*
Template Name: Press Page
*/

get_header(); ?>

<div class="container">
	<div id="content-area" class="clearfix">
			
		<h1 class="main_title"><?php the_title(); ?></h1>
			
			
		<?php 
		    $args = array( 'posts_per_page' => 50, 'category_name' => 'press'); 
			$posts_query = new WP_Query( $args );
    		while($posts_query->have_posts()) : 
        		$posts_query->the_post();
        		$link = get_permalink();
        		$title = get_the_title();
        		$date = get_the_date();                              
 		?>
            <header class="entry-header">
    			<h1 class="entry-title"><?php the_title(); ?></h1>
    			<?php
    			$image = get_field('icon');
				$size = 'medium'; // (thumbnail, medium, large, full or custom size)
				if( $image ) {
    				echo wp_get_attachment_image( $image, $size );
				}
				else {
					echo 'Field "icon" is not defined';
				}
    			$value = get_field( "text" );
				if( $value ) {
    				echo wp_kses_post( $value );
				} else {
    				echo 'Field "text" is not defined';
				}
				$value = get_field( "url" );
				if( $value ) {
    				echo wp_kses_post( $value );
				} else {
    				echo 'Field "url" is not defined';
				}
				?>
  			</header>
    	<?php endwhile; ?>
    

	</div>
</div>		
			
			
<?php get_footer(); ?>
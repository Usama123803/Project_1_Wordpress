<?php
/*
	Template Name: Portfolio Page
*/
get_header() ?>

	<?php  

		$args = array('post_type' => 'portfolio' , 'posts_per_page' => 1);
		$object = new WP_Query($args);

		if($object->have_posts()){
			while($object->have_posts()){
				$object->the_post();
	?>
		<?php get_template_part('postformat', 'archive'); ?>

		<?php
				}
			}
			wp_reset_postdata();		
		?>
		<hr>

<?php get_footer() ?>
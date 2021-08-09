<?php get_header() ?>

	<?php  

		$var1 = array(
			'include'=>'9 , 8'
		);
		$categories = get_categories($var1);
		foreach($categories as $category){?>
			<?php
				$args = array(
					'type'=>'post',
					'posts_per_page'=>1,
					'category__in'=>$category->term_id,
					'category__not_in'=>array( 10 ),
				);
				$object = new WP_Query($args);
				// $object = new WP_Query('type=post & posts_per_page=1 & category_name=category2');
				//Print 1 post not the first 2 posts
				// $object = new WP_Query('type=post & posts_per_page=1 & offset=2');

				if($object->have_posts()){
					while($object->have_posts()){
						$object->the_post();
			?>
				<?php get_template_part('postformat', 'wpcategory')?>

				<?php
						}
					}
					wp_reset_postdata();		
				?>
		<?php } ?>
			<hr>
	</div>

	<div class="col-xs-12 col-sm-8"><?php dynamic_sidebar('FirstSidebar'); ?></div>

</div>

<?php get_footer() ?>
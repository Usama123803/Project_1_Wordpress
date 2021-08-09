<?php get_header() ?>

<div class="row">
	<div class="col-xs-12 col-sm-8">
	<?php 
		$pageVariable = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
		$variable = array('posts_per_page' => 1 , 'paged' => $pageVariable);
		query_posts($variable);

		if(have_posts()){
			while(have_posts()){
				the_post();
	?>
	 <?php get_template_part('postformat', get_post_format());  ?>
	<?php			
			}
		?>
		<?php next_posts_link('<< Older Posts'); ?>

		<?php previous_posts_link('New Post >>'); ?>
	<?php	
		}		
	?>
	<?php wp_reset_query(); ?>
	</div>

	<div class="col-xs-12 col-sm-8"><?php dynamic_sidebar('FirstSidebar'); ?></div>

</div>

<?php get_footer() ?>
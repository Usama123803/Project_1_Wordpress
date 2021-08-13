<?php get_header() ?>

<div class="row">
	<div class="col-xs-12 col-sm-8">
	<?php 	if(have_posts()){?>

	<?php the_archive_title(); ?>
	<?php the_archive_description(); ?>	

	<?php 	while(have_posts()){
				the_post();
	?>

	<?php get_template_part('postformat', 'archive');  ?>

	<?php			
		}
	?>

	<?php the_posts_navigation(); ?>

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
<?php get_header() ?>

<div class="row">
	<div class="col-xs-12 col-sm-8">

	<?php 
		if(have_posts()){
			while(have_posts()){
				the_post();
	?>
	 <?php get_template_part('postformat', 'search');  ?>
	<?php			
			}
		}		
	?>
	</div>

	<div class="col-xs-12 col-sm-8"><?php dynamic_sidebar('FirstSidebar'); ?></div>

</div>

<?php get_footer() ?>
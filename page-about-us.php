<?php get_header() ?>
	
	<h1> <?php the_title(); ?> </h1>

	<h1>This is New Template working on by click on about us page</h1>
	 <small>Posted on : <?php the_time('F j, Y'); ?> At <?php the_time('g:i a'); ?> in , <?php the_category(); ?></small>
	 <hr>
	 <?php dynamic_sidebar('FirstSidebar'); ?>

<?php get_footer() ?>
<?php
/*
	Template Name: Contact Page
*/
get_header() ?>

	<h1>This is Contact Page</h1>
	<h1> <?php the_title(); ?> </h1>
	 <small>Posted on : <?php the_time('F j, Y'); ?> At <?php the_time('g:i a'); ?> in , <?php the_category(); ?></small>
	 <hr>
	 <?php dynamic_sidebar('FirstSidebar'); ?>

<?php get_footer() ?>
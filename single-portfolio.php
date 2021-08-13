<?php get_header() ?>

<div class="row">
	<div class="col-xs-12 col-sm-8">

	<?php
	if(have_posts()){
			while(have_posts()){
				the_post();
	?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php the_title(); ?>

		<?php 
			if( has_post_thumbnail() ) { ?>
				<div> <?php the_post_thumbnail(); ?></div>

		<?php } ?>

		<small> 
			<?php awesome_get_terms( $post->ID, 'field'); ?> ||
			<?php awesome_get_terms( $post->ID, 'tagss'); ?>
			<?php
				if( current_user_can('manage_options'))
				{
					echo ' || ';  
					edit_post_link();
				} 
			?> 
		</small>

		<p><?php the_content() ?></p>

		<hr>

		<div class="row">
			<div class="co-xs-6 text-left"><?php previous_post_link(); ?></div>
			<div class="co-xs-6 text-right"><?php next_post_link(); ?></div>
		</div>

	</article>

	<?php 
			}
		} 
	?>

	</div>

</div>

<?php get_footer() ?>
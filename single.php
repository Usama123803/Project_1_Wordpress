<?php get_header() ?>

<div class="row">
	<div class="col-xs-12 col-sm-8">

	<?php the_title(); ?>
	<?php 
		if( has_post_thumbnail() ) { ?>
			<div> <?php the_post_thumbnail(); ?></div>
	<?php } ?>

		<small> <?php the_category(); ?> || <?php the_tags(); ?> ||<?php edit_post_link(); ?> </small>

		<p><?php the_content() ?></p>

		<p>
			<?php 
				if( comments_open() )
				{ 
					comments_template(); 
				} 
				else
				{
					echo "<h4> No Comments </h4>";
				}
			?>
		</p>
		<?php previous_post_link(); ?>
		<?php next_post_link(); ?>
	</div>

	<div class="col-xs-12 col-sm-8"><?php dynamic_sidebar('FirstSidebar'); ?></div>

</div>

<?php get_footer() ?>
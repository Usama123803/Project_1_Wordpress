<a href="<?php the_permalink(); ?>"><h1><?php the_title(); ?></h1></a>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if( has_post_thumbnail()){ ?>
			<div class="thumbnail"><?php the_post_thumbnail('thumbnail') ?></div>
	<?php } ?>

	<small><?php the_category(); ?></small>
	<hr>
</article>
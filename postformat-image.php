<a href="<?php the_permalink(); ?>"><h1><?php the_title(); ?></h1></a>
<div class="thumbnail-img"><?php the_post_thumbnail('thumbnail'); ?></div>
<small>Posted on : <?php the_time('F j, Y'); ?> At <?php the_time('g:i a'); ?> in , <?php the_category(); ?></small>
<hr>
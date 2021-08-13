<?php
/*
	Template Name: API Page
*/ 
get_header() ?>

<div class="row">
	<div class="col-xs-12 col-sm-8">

	<?php
	if(have_posts()){
			while(have_posts()){
				the_post();
	?>
	<div class="admin-quick-add">
		<h3>Quick Add Post</h3>
		<input type="text" name="title" placeholder="Title">
		<input name="content" placeholder="Content"></input>
		<button id="quick-add-button">Create Post</button>	
	</div>
	<?php 
			}
		} 
	?>

	</div>

</div>

<?php get_footer() ?>
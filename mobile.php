<?php
/*
	Template Name: Mobile
*/
	get_header();
?>

<form method="post">

	<label for="name">Mobile Name :</label>
	<input type="text" name="name" id="name">
	<br>

	<label for="description">Description :</label>
	<input type="text" name="description" id="description">
	<br>

	<label for="price_id">Price :</label>
	<input type="text" name="price_id" id="price_id">
	<br>

	<label for="mobile_id">Model :</label>
	<input type="text" name="mobile_id" id="mobile_id">
	<br>

	<label for="brand_id">Brand :</label>
	<input type="text" name="brand_id" id="brand_id">
	<br>

	<button type="submit">Submit</button>
	
</form>

<?php get_footer() ?>
<?php
/*
	Template Name: Mobile
*/
	get_header();
?>

<form action="#" method="post" id="formid" data-url="<?php echo admin_url('admin-ajax.php'); ?>">

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

	<!-- For Ajax Form Submittion -->
	<input type="hidden" name="action" value="submit_variable1">
	
</form>

<script>

	document.addEventListener('DOMContentLoaded', function(e) {

		var variable1 = document.getElementById('formid');

		variable1.addEventListener('submit', (e) => {
			e.preventDefault();

			var data = {
				name        :  variable1.querySelector('[name="name"]').value,
				description :  variable1.querySelector('[name="description"]').value,
				price_id    :  variable1.querySelector('[name="price_id"]').value,
				mobile_id   :  variable1.querySelector('[name="mobile_id"]').value,
				brand_id    :  variable1.querySelector('[name="brand_id"]').value
			}

			var url = variable1.dataset.url;
			// console.log(url);

			let parameters = new URLSearchParams(new FormData(variable1));

			fetch(url, {
				method : "POST",
				body   : parameters
			});
			// .then(result => result.json())

			variable1.querySelector('[name="name"]').value = '';
			variable1.querySelector('[name="description"]').value = '';
			variable1.querySelector('[name="price_id"]').value = '';
			variable1.querySelector('[name="mobile_id"]').value = '';
			variable1.querySelector('[name="brand_id"]').value = '';
		})

	});

</script>

<?php get_footer() ?>
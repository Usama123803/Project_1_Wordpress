<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>New Theme</title>
	<?php wp_head(); ?>
</head>
	<?php get_search_form(); ?>
	<?php 
		if(is_front_page())
		{
			$object = array('classNameExist');
		}
		else
			$object = array('NoClassExist');	
	?>
<body <?php body_class($object); ?>>
	
	<?php 
		$args = array(
    		'menu_class' => 'menu-header-menu-container',
    		'theme_location' => 'primary',
    		'walker' => new Walker_Nav_Primary()
    	);
		wp_nav_menu($args);
    ?>
<header>This is Header</header>
<?php

function styleAndjs()
{
	wp_enqueue_style('customstyle', get_template_directory_uri().'/css/NewTheme.css');
	wp_enqueue_script('customstyle', get_template_directory_uri().'/js/NewTheme.js');
	wp_enqueue_style('bootstrap', get_template_directory_uri().'/css/bootstrap.css' );
	wp_enqueue_script('bootstrap', get_template_directory_uri().'/js/bootstrap.min.js', array( 'jquery' ) );
}
add_action('wp_enqueue_scripts', 'styleAndjs');

function menus()
{
	add_theme_support('menus');
	
	register_nav_menu('primary','My First Menu');
	register_nav_menu('secondary','My Second Menu');
}
add_action('init','menus');

add_theme_support('custom-background');
add_theme_support('custom-header');
add_theme_support('post-thumbnails');

add_theme_support('post-formats',array('aside','image','video'));

function sidebar(){
	register_sidebar(array( 
		'name'=>'FirstSidebar',
		'id'=>'idofsidebar',
		'class'=>'custom',
		'description'=>'Standard Sidebar'
		// 'before_widget'=>'',
		// 'after_widget'=>'',
		// 'before_title'=>'',
		// 'after_title'=>''
	));
}

add_action('widgets_init','sidebar');

add_theme_support('html5',array('search-form'));

require get_template_directory() . '/inc/walker.php';

?>
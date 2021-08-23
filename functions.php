<?php

function styleAndjs()
{
	wp_enqueue_style('customstyle', get_template_directory_uri().'/css/NewTheme.css');
	wp_enqueue_script('customstyle', get_template_directory_uri().'/js/NewTheme.js');
	wp_enqueue_style('bootstrap', get_template_directory_uri().'/css/bootstrap.css' );
	wp_enqueue_script('bootstrap', get_template_directory_uri().'/js/bootstrap.min.js', array( 'jquery' ) );
	wp_enqueue_script('api-custom', get_template_directory_uri().'/js/custom-api.js');
	// wp_localize_script('api-custom', 'additionalData', array(
	// 	'nonce' => wp_create_nonce( 'wp_rest' )
	// ));

}
add_action('wp_enqueue_scripts', 'styleAndjs');

//Menu : 
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

//Sidebar : 
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

//Custom Post Practice :
function awesome_custom_post_type(){
	$labels = array(
		'name' => 'Portfolio',
		'singular_name' => 'Portfolio',
		'add_new' => 'Add Item',
		'all_items' => 'All Item',
		'add_new_item'=> 'Add Item',
		'edit_item' => 'Edit Item',
		'new_item' => 'New Item',
		'view_item' => 'View Item',
		'search-item' => 'Search Portfolio',
		'not_found' => 'No items found',
		'not_found_in_trash' => 'No item found in trash',
		'parent_item_colon' => 'Parent Item'
	);

	$args = array(
		'labels' => $labels,
		'public' => true,
		'has_archive' => true,
		'publicly_queryable' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'supports' => array(
			'title',
			'editor',
			'excerpt',
			'thumbnail',
			'revisions',
		),
		// 'taxonomies' => array('category', 'post_tag'),
		'menu_position' => 5,
		'exclude_from_search' => false
	);

	register_post_type('portfolio', $args);
}
add_action('init','awesome_custom_post_type');

function awesome_custom_taxonomies(){
	$labels = array(
		'name' => 'Fields',
		'singular_name' => 'Type',
		'search-items' => 'Search Fields',
		'all_items' => 'All Fields',
		'parent_item' => 'Parent Type',
		'parent_item_colon' => 'Parent Type',
		'edit_item' => 'Edit Type',
		'update_item' => 'Update Type',
		'add_new_item'=> 'Add New Type',
		'new_item_name'=> 'New Type Name',
		'menu_name' => 'Fields'		
	);

	$args = array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'field')
	);

	register_taxonomy('field', array('portfolio'), $args);

	register_taxonomy('tagss', 'portfolio', array(
		'label' => 'Tagss',
		'rewrite' => array( 'slug' => 'tagss' ),
		'hierarchical' => 'false'
	));
}
add_action('init','awesome_custom_taxonomies');

// Custom Terms like Tags Discription etc : 
function awesome_get_terms( $postID, $term)
{

	$terms_list = wp_get_post_terms($postID, $term);
	$output = '';

	$i=0;
	foreach ($terms_list as $term)
	{	
		$i++;
		if ($i>1) { $output .= ',';}
		$output .= '<a href="' . get_term_link( $term ) . '">'. $term->name .'</a> ';
	}

	return $output;
}

class wpc_post_editor
{
	public function __construct()
	{
		add_action('add_meta_boxes',[$this, 'create_meta_box']);
		add_action('save_post',[$this, 'save_editor']);
	}

	public function create_meta_box()
	{
		// add_meta_box('id','title',[$this, 'meta_box_html'],['post']);
		add_meta_box('wpc_editor','TITLE',[$this, 'meta_box_html'],['post']);
	}

	public function save_editor( $post_id )
	{
		if(isset($_POST['wpc_post_editor']) && is_numeric($_POST['wpc_post_editor']))
		{
			$editor_id = sanitize_text_field($_POST['wpc_post_editor']);
			update_post_meta($post_id, 'wpc_post_editor', $editor_id);
		}
	}

	public function meta_box_html()
	{

		// var_dump(get_post_meta(get_the_ID(),'wpc_post_editor',true));

		$user_query = new WP_User_Query([
			'role' => 'editor',
			'number' => '-1',
			'fields' => [
				'display_name',
				'ID',
			],
		]);

		$editors = $user_query->get_results();

		if( !empty( $editors )){

		?>

			<label for="post_editor"> Editor : </label>
			<select name="wpc_post_editor" id="post_editor">
				<option> Select  </option>
				<?php
					foreach( $editors as $editor ){
						// echo '<option value="'. $editor->ID .'">'. $editor->display_name .'</option>' ; 
						echo '<option value="'. $editor->ID .'" 
						'.selected(get_post_meta(get_the_ID(),'wpc_post_editor',true),$editor->ID,false).'>'
						.$editor->display_name .'</option>' ; 
					}
				?>
			</select>

		<?php

		}
		else
		{
			echo '<p> No Editor Found </p>';
		}
 	}
}
new wpc_post_editor();

//Custom Post : 
function Mobile_post(){
	$labels = array(
		'has_archive'=> true,
		'name' => 'Mobile',
		'singular_name' => 'Mobile',
		'add_new' => 'Add Item',
		'all_items' => 'All Item',
		'add_new_item'=> 'Add Item',
		'edit_item' => 'Edit Item',
		'new_item' => 'New Item',
		'view_item' => 'View Item',
		'search-item' => 'Search Mobile',
		'not_found' => 'No items found',
		'not_found_in_trash' => 'No item found in trash',
		'parent_item_colon' => 'Parent Item'
	);

	$args = array(
		'labels' => $labels,
		'public' => true,
		'has_archive' => true,
		'publicly_queryable' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'supports' => array(
			'title',
			'editor',
			'excerpt',
			'thumbnail',
			'revisions',
		),
		// 'taxonomies' => array('category', 'post_tag'),
		'menu_position' => 5,
		'exclude_from_search' => false
	);

	register_post_type('mobile', $args);
}
add_action('init','Mobile_post');

//Custom Taxonomy :
function Mobile_taxonomy(){
	$labels = array(
		'name' => 'Brands',
		'singular_name' => 'Brand',
		'search-items' => 'Search Brands',
		'all_items' => 'All Brands',
		'parent_item' => 'Parent Brand',
		'parent_item_colon' => 'Parent Brand',
		'edit_item' => 'Edit Brand',
		'update_item' => 'Update Brand',
		'add_new_item'=> 'Add New Brand',
		'new_item_name'=> 'New Brand Name',
		'menu_name' => 'Brands'		
	);

	$args = array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'brand')
	);

	register_taxonomy('brand', array('mobile'), $args);
}
add_action('init','Mobile_taxonomy');

//Custom Fields :
add_action('add_meta_boxes','mobile_add_meta_box');
function mobile_add_meta_box(){
	add_meta_box(
		'mobile_details',
		'Mobile Details',
		'mobile_callback',
		'mobile',
		'side',
		'default'
	);
}
function mobile_callback( $post )
{
	wp_nonce_field( 'mobile_save_post', 'mobile_add_meta_box_nonce');

	$display = get_post_meta($post->ID, 'mobile_info_key', true);

	$var1 = isset($display['mobile_id']) ? esc_attr($display['mobile_id']) : '';
	$var2 = isset($display['brand_id']) ? esc_attr($display['brand_id']) : '';
	$var3 = isset($display['price_id']) ? esc_attr($display['price_id']) : '';
	echo '<label for="mobile_id"> Model: <label>';
	echo '<input type="text" id="mobile_id" name="mobile_id" placeholder="Enter Model" value="'.$var1 .'">' ;
	echo "<br>";
	echo '<label for="brand_id"> Brand: <label>';
	echo '<input type="text" id="brand_id" name="brand_id" placeholder="Enter Brand" value="'.$var2 .'">' ;
	echo "<br>";
	echo '<label for="price_id"> Price: <label>';
	echo '<input type="text" id="price_id" name="price_id" placeholder="Enter Price" value="'.$var3 .'">' ;
}

add_action( 'save_post', 'mobile_save_post' );
function mobile_save_post( $post_id )
{
	if( ! isset($_POST['mobile_add_meta_box_nonce']) ){
		return ;
	}
	if( ! wp_verify_nonce( $_POST['mobile_add_meta_box_nonce'], 'mobile_save_post') ){
		return ;
	}
	if( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE){
		return ;
	}
	if( ! current_user_can( 'edit_post', $post_id)){
		return ;
	}

	if( ! isset($_POST['mobile_id'])){
		return ;
	}

	$display = array(
		'mobile_id' => sanitize_text_field($_POST['mobile_id']),
		'brand_id' => sanitize_text_field($_POST['brand_id']),
		'price_id' => sanitize_text_field($_POST['price_id'])
	);

	update_post_meta($post_id,'mobile_info_key',$display);
}

// //Custom Form :
// if(isset($_POST['name'])){

// 	// $mobile_id = $_POST['mobile_id'];
// 	// $brand_id = $_POST['brand_id'];
// 	// $price_id = $_POST['price_id'];

// 	$data = array(
// 		'mobile_id' => sanitize_text_field($_POST['mobile_id']),
// 		'brand_id' => sanitize_text_field($_POST['brand_id']),
// 		'price_id' => sanitize_text_field($_POST['price_id'])
// 	);

// 	$my_post = array(
// 		'post_type' => 'mobile',
// 		'post_title' => $_POST['name'],
// 		'post_description' => $_POST['description'],
// 		'post_status' => 'publish',
// 		'meta_input' => array(
// 			'mobile_info_key' => $data
// 		),
// 	);

// 	wp_insert_post($my_post);

// 	// print_r($my_post);
// }

//Ajax Request
add_action('wp_ajax_submit_variable1', 'submit_variable1');
function submit_variable1()
{
	// echo "Submitted";

	if(isset($_POST['name'])){

		$mobile_id  = sanitize_text_field($_POST['mobile_id']);
		$brand_id   = sanitize_text_field($_POST['brand_id']);
		$price_id   = sanitize_text_field($_POST['price_id']);

		$display = array(
			'mobile_id' => $mobile_id,
			'brand_id'  => $brand_id,
			'price_id'  => $price_id
		);

		$args = array(
			'post_type' => 'mobile',
			'post_title' => $_POST['name'],
			'post_content' => $_POST['description'],
			'post_status' => 'publish',
			'meta_input' => array(
				'mobile_info_key' => $display
			),
		);

		wp_insert_post($args);

	}

	wp_die();
}

?>
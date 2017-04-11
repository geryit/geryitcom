<?php

define('ROOT', get_bloginfo('template_directory'));
define('CURRENT_URL', 'https://'.$_SERVER["HTTP_HOST"].$_SERVER['REQUEST_URI']);
define('URL', get_bloginfo('url'));

function my_init_method() {
	wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js');
}

//Register Thumbnail sizes
add_theme_support('post-thumbnails');
set_post_thumbnail_size( 120, 0, true );
add_image_size('fb', 90, 90, true );

add_action('init', 'my_init_method');

include 'meta-box.php';

include_once('simple_html_dom.php');
function share_img($src){
	global $post;

	if (is_single()){
		$first_image_id = GetBetween($post->post_content, 'wp-image-', '"');
		if(has_post_thumbnail()){
			$images = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'fb');
			$src = $images[0];
		}elseif($first_image_id){
			$images = wp_get_attachment_image_src($first_image_id, 'fb');
			$src = $images[0];
		}
	}
	return $src;
}

function GetBetween($content,$start,$end){
	$r = explode($start, $content);
	if (isset($r[1])){
		$r = explode($end, $r[1]);
		return $r[0];
	}
	return '';
}


function geryit_scripts() {
    wp_enqueue_style( 'styles', '//'.$_SERVER['HTTP_HOST'].'/dist/styles.min.css',array(), null );
    wp_enqueue_script( 'scripts', '//'.$_SERVER['HTTP_HOST'].'/dist/scripts.min.js', array('jquery'), null, true);
}
add_action( 'wp_enqueue_scripts', 'geryit_scripts' );

add_filter( 'w3tc_can_print_comment', '__return_false', 10, 1 );



//function prefix_add_footer_styles() {
//    wp_enqueue_style( 'main-css', get_stylesheet_uri() );
//
//    wp_deregister_script('jquery'); // Remove WordPress core's jQuery
//    wp_register_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js', false, null, false);
//    wp_enqueue_script( 'custom', get_template_directory_uri().'/js/custom.js',array( 'jquery' ));
//};
//add_action( 'get_footer', 'prefix_add_footer_styles' );

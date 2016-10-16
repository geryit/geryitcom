<?php

define('ROOT', get_bloginfo('template_directory'));
define('CURRENT_URL', 'http://'.$_SERVER["HTTP_HOST"].$_SERVER['REQUEST_URI']);
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

function browser_body_class($classes) {
 
    // A little Browser detection shall we?
    $browser = $_SERVER[ 'HTTP_USER_AGENT' ];
 
    // Mac, PC ...or Linux
    if ( preg_match( "/Mac/", $browser ) ){
        $classes[] = 'mac';
 
    } elseif ( preg_match( "/Windows/", $browser ) ){
        $classes[] = 'windows';
 
    } elseif ( preg_match( "/Linux/", $browser ) ) {
        $classes[] = 'linux';
 
    } else {
        $classes[] = 'unknown-os';
    }
 
    // Checks browsers in this order: Chrome, Safari, Opera, MSIE, FF
    if ( preg_match( "/Chrome/", $browser ) ) {
        $classes[] = 'chrome';
 
        preg_match( "/Chrome\/(\d.\d)/si", $browser, $matches);
        $classesh_version = 'ch' . str_replace( '.', '-', $matches[1] );
        $classes[] = $classesh_version;
 
        } elseif ( preg_match( "/Safari/", $browser ) ) {
            $classes[] = 'safari';
 
            preg_match( "/Version\/(\d.\d)/si", $browser, $matches);
            $sf_version = 'sf' . str_replace( '.', '-', $matches[1] );
            $classes[] = $sf_version;
 
         } elseif ( preg_match( "/Opera/", $browser ) ) {
            $classes[] = 'opera';
 
            preg_match( "/Opera\/(\d.\d)/si", $browser, $matches);
            $op_version = 'op' . str_replace( '.', '-', $matches[1] );
            $classes[] = $op_version;
 
         } elseif ( preg_match( "/MSIE/", $browser ) ) {
            $classes[] = 'msie';
 
            if( preg_match( "/MSIE 6.0/", $browser ) ) {
                $classes[] = 'ie6';
            } elseif ( preg_match( "/MSIE 7.0/", $browser ) ){
                $classes[] = 'ie7';
            } elseif ( preg_match( "/MSIE 8.0/", $browser ) ){
                $classes[] = 'ie8';
            } elseif ( preg_match( "/MSIE 9.0/", $browser ) ){
                $classes[] = 'ie9';
            }
 
            } elseif ( preg_match( "/Firefox/", $browser ) && preg_match( "/Gecko/", $browser ) ) {
                $classes[] = 'firefox';
 
                preg_match( "/Firefox\/(\d)/si", $browser, $matches);
                $ff_version = 'ff' . str_replace( '.', '-', $matches[1] );
                $classes[] = $ff_version;
 
            } else {
                $classes[] = 'unknown-browser';
            }
 
    return $classes;
}
 
add_filter('body_class','browser_body_class');

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
    wp_enqueue_style( 'styles', '//'.$_SERVER['HTTP_HOST'].'/dist/styles.min.css?v=2374',array(), null );
    wp_enqueue_script( 'scripts', '//'.$_SERVER['HTTP_HOST'].'/dist/scripts.min.js?v=2374', array('jquery'), null, true);
}
add_action( 'wp_enqueue_scripts', 'geryit_scripts' );


//function prefix_add_footer_styles() {
//    wp_enqueue_style( 'main-css', get_stylesheet_uri() );
//
//    wp_deregister_script('jquery'); // Remove WordPress core's jQuery
//    wp_register_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js', false, null, false);
//    wp_enqueue_script( 'custom', get_template_directory_uri().'/js/custom.js',array( 'jquery' ));
//};
//add_action( 'get_footer', 'prefix_add_footer_styles' );

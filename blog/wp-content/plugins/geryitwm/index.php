<?php

/*

Plugin Name: geryitwm

*/
global $wpdb;

define('PATH', plugin_basename( dirname(__FILE__)));//rafineri

define('PLUGIN_PATH', WP_CONTENT_URL.'/plugins/'.plugin_basename( dirname(__FILE__)));// http://www.trafo.com.tr/projects/cms/wp-content/plugins/rafineri

define('ADMIN_PHP', "https://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']);// http://www.trafo.com.tr/projects/cms/wp-admin/admin.php

define("TEMPLATE_DIR", get_bloginfo('template_directory'));//http://www.rafineri.net/2009/wp-content/themes/rafineri

$template_PATH = explode("/",TEMPLATE_DIR);

define("TEMPLATE_PATH", end($template_PATH));//rafineri



$act = $_GET["act"];








	

if($act=="add"){
	$title = $_POST["title"];

	$year = $_POST["year"];

	$des = $_POST["des"];

	$shortDes = $_POST["shortDes"];

	$tags = $_POST["tags"];

	$url = $_POST["url"];

	$img = strtolower(basename($_FILES["img"]["name"]));



	$target_path = "../../images/works_full/".$img;

	move_uploaded_file($_FILES['img']['tmp_name'], $target_path);

	

	$lastOrd = mysql_fetch_object(mysql_query("SELECT * FROM ".$wpdb->prefix."works order by ord desc"));

	$lastOrd = $lastOrd->ord + 1;

	mysql_query("insert into ".$wpdb->prefix."works values(NULL, '$lastOrd', '$title', '$year', '$shortDes', '$des', '$tags', '$url','".$img."') ") or die(mysql_error());
	
	header("Location:admin.php?page=geryitwm/index.php&msg=Work Added");



}



if($act=="edit"){

	$wid = $_POST["wid"];

	$title = $_POST["title"];

	$year = $_POST["year"];

	$shortDes = $_POST["shortDes"];

	$des = $_POST["des"];

	$tags = $_POST["tags"];

	$url = $_POST["url"];

	$img = strtolower(basename($_FILES["img"]["name"]));



	$target_path = "../../images/works_full/".$img; 

	move_uploaded_file($_FILES['img']['tmp_name'], $target_path);

	$imgQ = "";

	if($img) $imgQ = ", img = '$img'";

	

	mysql_query("update ".$wpdb->prefix."works set title = '$title', year = '$year', shortDes = '$shortDes', des = '$des', tags = '$tags', url = '$url' $imgQ where wid = $wid ");

	header("Location:admin.php?page=geryitwm/index.php&msg=Work Edited");



}



if($act=="del"){

	$wid = $_GET["wid"];

	mysql_query("delete from ".$wpdb->prefix."works where wid='$wid' ");

	header("Location:admin.php?page=geryitwm/index.php&msg=Work Deleted");



}



if($act=="move"){

	$newOrd = $_GET["newOrd"];

	$currentWid = $_GET["currentWid"];

	$effectedNewOrd = $_GET["effectedNewOrd"];

	$effectedId = $_GET["effectedId"];

	

	mysql_query("update ".$wpdb->prefix."works set ord = $newOrd where wid = $currentWid ");

	mysql_query("update ".$wpdb->prefix."works set ord = $effectedNewOrd where wid = $effectedId ");

	

	header("Location:admin.php?page=geryitwm/index.php&msg=Work Moved");



}









	

add_action('admin_head', 'geryitwmHeader');



function geryitwmHeader(){

	include "geryitwmHeader.php";

}



add_action('admin_menu', 'geryitwmMenu');

function geryitwmMenu(){

	add_menu_page('geryitwm CMS', 'geryitwm', 8, __FILE__, 'geryitwmWorks');

	add_submenu_page(__FILE__, 'Works', 'Works', 8, __FILE__, 'geryitwmWorks');

}





function geryitwmWorks(){

	global $wpdb;

	include "geryitwmWorks.php";

}





?>

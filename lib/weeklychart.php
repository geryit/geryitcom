<!doctype html>
<html>
	<head>
		<title>Get last.fm weekly chart</title>
		<style>
		body{
			background: #000;
			color: #fff;
		}
		a{
			color: #ccc;
		}
		</style>
	</head>
	<body>
		<?php
		
		// Set up the required variables first
		$method = "user.getweeklyartistchart"; //Enter method. Visit http://www.last.fm/api for more methods
		$username = "gxlrygt"; // Enter your username here
		$apikey = "bb3fa9f612242ec47cb71e401e64de90"; // Enter your API Key here
		$limit = 5; //Enter the number of artist will be displayed
		
		// Construct the URL, and feed it through SimpleXML
		$feed = simplexml_load_file("https://ws.audioscrobbler.com/2.0/?method=".$method."&user=".$username."&api_key=".$apikey);
		
		//Get artists
		$artist = $feed->weeklyartistchart->artist;
		
		//Get chart
		for($i=0;$i<$limit;$i++){
			$a = $artist[$i];
			echo "#".($i+1)." - <a href='".$a->url."'>".$a->name."</a> - ".$a->playcount." plays <br />";
		}
		
		?>
	</body>
</html>

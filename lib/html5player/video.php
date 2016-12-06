<?
$quality = $_POST["quality"];
if($quality=="sd"){?>
	<div class="video-js-box vim-css">
	<video class="video-js" width="415" height="205" poster="https://www.mindwork3d.com/images/poster.png" controls preload>
		<source src="https://www.mindwork3d.com/video/415x205.mp4" type='video/mp4; codecs="avc1.42E01E, mp4a.40.2"'>
		<source src="https://www.mindwork3d.com/video/415x205.ogv" type='video/ogg; codecs="theora, vorbis"'>
	</video>
	</div>
<? }else{?>
    <div class="video-js-box vim-css">
	    <video class="video-js" width="415" height="205"poster="https://www.mindwork3d.com/images/poster.png" controls preload>
		    <source src="https://www.mindwork3d.com/video/640x316.mp4" type='video/mp4; codecs="avc1.42E01E, mp4a.40.2"'>
		    <source src="https://www.mindwork3d.com/video/640x316.ogv" type='video/ogg; codecs="theora, vorbis"'>
	    </video>
    </div>
<? }?>

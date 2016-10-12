function ready(){
	load_showreel("sd");
}

function load_showreel(quality){
	$('#video_holder').html("Loading Video...");
	$('#video_holder').show();
	$.ajax({
		type: "POST",
		url: "video.php",
		data: "quality=" + quality,
		success: function(msg){
			$('#video_holder').html(msg);
			VideoJS.setup();
			$(".vjs-controls").append('<li class="vjs-hd-control" title="Switch to High Definition"><span>HD</span></li>');
			
			var hd = $(".vjs-hd-control span");
			if (quality == "sd") {
				hd.removeClass("hd_on");
				hd.attr("title", "Switch to High Definition");
			}
			else {
				hd.addClass("hd_on");
				hd.attr("title", "Switch to Low Definition");
			}
			$(".vjs-hd-control").click(function(){
				pauseVideo();
				if (quality == "sd") 
					load_showreel("hd");
				else 
					load_showreel("sd");
			});
			$(".vjs-fullscreen-control").attr("title", "Fullscreen/Standart View");
			if (window.played_before) 
				playVideo();
			window.played_before = 1;
		}
	});
}

function playVideo(){
	v = $("video")[0];
	v.play();
}

function pauseVideo(hide){
	v = $("video")[0];
	v.src = "";
	v.load();
	v.pause();
}

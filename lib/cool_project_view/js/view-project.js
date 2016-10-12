$().ready(function(){
	
	/* Show container and load url */
	$('.view-project').click(function(){
		var href = $(this).attr('href');
		$('#project-frame').attr("src", href);
		$('body').addClass('oyh'); //Hide body's vertical scrollbar 
		$('#project-frame-container').fadeIn();
		return false;
	});
	
	/* Hide container */
	$('#back-to-projects').click(function(){
		$("body").removeClass("oyh");
		$('#project-frame-container').fadeOut();
		$("#project-frame").attr('src', '');
		return false;
	});
});
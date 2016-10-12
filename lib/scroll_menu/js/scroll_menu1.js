$(function(){
	$("#menu_mask ul li").each(function(){
		var ul = $(">ul",this);
		var thisLI = $(this);
		var otherLIS = $(this).siblings();
		if($(">a",this).attr("href") == window.location){
			$(this).parents().slideDown("fast");
		}
		$(">a",this).click(function(){
			if(ul.is(":hidden")){
				otherLIS.find("ul").slideUp("fast");
				ul.slideDown("fast",function(){putSigns();});
			}else{
				thisLI.find("ul").slideUp("fast");
				ul.slideUp("fast",function(){putSigns();});
			}
			
			if(ul.length) return false;
		});
	});
	
	$("#menu_mask").mousemove(function(e){
		var mouseY = e.pageY;
		var mask = $("#menu_mask");
		var ul = $(">ul",mask);
		
		if(ul.height()>mask.height()){
			var maskTop = parseInt(mask.offset().top);
			
			var posPers = (mouseY - maskTop)*100/mask.height();
			//console.log(ul.height());
			
			y = (ul.height() - mask.height())*posPers/100;
			ul.css("top",-y);
		}
	
	});
	putSigns();
	
})

function putSigns(){
	$("#menu_mask ul li").each(function(){
		var ul = $(">ul",this);
		$(">a>b",this).remove();
		if(ul.length && ul.is(":hidden")){
			$(">a",this).prepend("<b>+</b>");
		}else{
			$(">a",this).prepend("<b>-</b>");
		}
	})
}
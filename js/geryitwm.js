/////////////////////////////////////////////////////////////////ONLOAD//////////////////////////////////////////////////////////////////////////////////////////
$(document).ready(function(){
	
	$("#addAgencyWork").submit(function(){
		//$(this).find("input,textarea").attr("disabled", true);
		$(this).find(".loading").addClass("vv");
		
		window.urlStr="";
		window.error=0;
		
		$(this).find("[name=workTitle]").validate(1);
		$(this).find("[name=year]").validate(4);
		$(this).find("[name=agency]").validate(1);
		$(this).find("[name=role]").validate(1);
		$(this).find("[name=link]").validate(1);
		$(this).find("[name=info]").validate(1);
		
		if(window.error==0){
			$.ajax({
				type: "POST",
				url: "../wp-content/plugins/"+PATH+"/ajax.php",
				data: "act=addAgencyWork"+window.urlStr,
				success: function(msg){
					$(".widefat").append(msg);
					$("#addAgencyWork").find(".loading").removeClass("vv");
					$("#addAgencyWork").find("input,textarea").val("");
				}
			});
		}
		
		return false;

	});
	
	

});
//////////////////////////////////////////////////////////////////ONLOAD//////////////////////////////////////////////////////////////////////////////////////////

jQuery.fn.validate = function(minLength){
	$(this).removeClass("fieldError");
	if($(this).val().length<minLength){
		$(this).addClass("fieldError");
		if(window.error==0) $(this).focus();
		window.error=1;
		$("#addAgencyWork").find(".loading").removeClass("vv");
	}else{
		window.urlStr += "&"+$(this).attr("name")+"="+$(this).val();
	}
}



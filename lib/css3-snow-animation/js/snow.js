/* Namespace */
var snow = {
	snowCount : 200, // Number of snowflakes will be created
	container: "snowContainer", // Container Id
	init : function(){
		/* Detect if the browser is a Webkit browser */
		if(navigator.userAgent.indexOf("AppleWebKit")<0){
			document.write("<div style='position:absolute;top:30px;padding:30px'>Only Webkit browsers will show the animation!</div>");
		};
	
		/* Create container and add children snowflakes */
		var container = document.getElementById(this.container);
		for (var i = 0; i < this.snowCount; i++){
		    container.appendChild(this.createSnow());
		}
	},
	/* Create snowflakes with random x-position, random size and random timing effects */
	createSnow : function (){
		var div = document.createElement("div");
		var getRandom = this.getRandom;
		div.style.left = Math.floor(getRandom(1,100))+"%";
		div.style.webkitAnimationDuration = getRandom(8,18)+"s";
		div.style.webkitAnimationDelay = getRandom(0,10)+"s";
		div.style.backgroundSize = getRandom(80,120)+"%";
		return div;
	},
	/* Generate random numbers with 'max' and 'min' values  */
	getRandom : function (min, max){  
	  return (Math.random() * (max - min + 1) + min);  
	}
	
}

snow.init(); //Start snowing
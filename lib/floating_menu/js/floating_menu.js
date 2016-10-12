var floatingMenu = Class.create({
	initialize : function(elm, options) {
		elm.each(function(elm){
			var menu = elm;
			var topOfMenu = menu.cumulativeOffset().top;
			Event.observe(window,'scroll', function(evt) {
				var y = document.viewport.getScrollOffsets().top;
				if (y >= topOfMenu) {
					menu.addClassName('fixed');
				} else {
					menu.removeClassName('fixed');
				}
			});
		}.bind(this));
		
		this.options = Object.extend({}, options || {});

	}
	
});

document.observe("dom:loaded", function() {
	new floatingMenu($$('.floating_menu'));
});
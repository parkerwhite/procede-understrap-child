/**
 * Nav Fix for Dropdown Gaps (Bootstrap)
 *
 * This jQuery fixes hover state issues when the menu dropdown
 * has a gap from its parent nav item. This adds a slight delay
 * to allow the cursor to cross the gap before the dropdown is
 * closed.
 */
(function( $ ) {
	'use strict';

	var timer;
	var ref;

	$("#main-menu > .nav-item")
		.on("mouseover", showDropdown)
		.on("mouseleave", function(){
			timer = setTimeout( hideDropdown, 250);
		});

	function showDropdown() {
		clearTimeout(timer);
		hideDropdown();
		ref = $(this);
		ref.addClass("show").find(".dropdown-menu").addClass("show");
	}
	function hideDropdown() {
		if (ref)
			ref.removeClass("show").find(".dropdown-menu").removeClass("show");
	}

	var navTopH = $('#top-nav').height();
	var navMainH = $('#main-nav').height();
	var navHeight = navTopH + navMainH;
	
})(jQuery);

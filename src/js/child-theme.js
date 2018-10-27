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

/**
 * Set Carousel Item heights
 *
 * The following jQuery sets the height of each `.carousel-item` 
 * to the height of the largest carousel item in the set. This 
 * prevents unusual resizing issues for dynamic text lengths.
 */
(function( $ ) {
	function setCarouselHeights($carousel) {
		var maxCarouselItemHeight = Math.max.apply(null, $carousel.find(".carousel-item").map(function (){
			return $(this).height();
		}).get());
		$carousel.find(".carousel-item").each(function(){
			$(this).css("height", maxCarouselItemHeight);
		});
	}
	$(".carousel").each(function(){
		setCarouselHeights($(this));
	});
	$(window).on('resize', function(){
		$(".carousel").each(function(){
			setCarouselHeights($(this));
		});
	});
})(jQuery);

$(function(){

	/* Toggle Code View */
	/* Uncomment following statement to turn code view on by default */
	$('body').removeClass('pat-res-no-code');
	$(".pat-res-code-toggle").html('Hide Code');
	
	$('.pat-res-code-toggle').click(function(e) {
		e.preventDefault();
		var hasclass = $('body').hasClass('pat-res-no-code');
		$(this).html((hasclass ? 'Hide Code' : 'Show Code'));
		$('body').toggleClass('pat-res-no-code');
	});
	
	/* Implement live scrolling when clicking on menu links */
	$('.pat-res-nav #main-menu a, .pat-res-nav a.brand, .pat-res-btt').click(function(e) {
		e.preventDefault();
		var menuTarget = $(this).attr('href');
		scrollToAnchor(menuTarget);
	});
	
	/* Menu Toggle on smaller screens */
	$('.pat-res-nav .btn-navbar').click(function() {
		$('pat-res-nav .nav-collapse').toggleClass('collapse');
	});
	
	/* Implement Search */
	var availableAnchors = [];
  $('div.searchable').each(function() {
    var href = '#' + $(this).attr('id');
    var title = $(this).attr('title');
    availableAnchors.push({ label: title, value: href });
  });
	$('.pat-res-search-query').typeahead({
		source: availableAnchors
	});
	
	$('.pat-res-search-query').on('selected', function () {
		var chosenItem = $('.pat-res-nav .typeahead.dropdown-menu .active').attr('data-value');
		scrollToAnchor(chosenItem);
	});
	
	function scrollToAnchor(target) {
		//get the top offset of the target anchor
    var target_offset = $(target).offset();
    var target_top = target_offset.top;
    //goto that anchor by setting the body scroll top to anchor top
    $('html, body').animate({scrollTop:target_top}, 500);
	}
		
});


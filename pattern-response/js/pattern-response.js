$(function(){

	// Toggle Code View
	// Comment out following statements to turn code view off by default
	$('body').removeClass('pat-res-no-code');
	$(".pat-res-code-toggle").html('Hide Code');
	
	$('.pat-res-code-toggle').click(function(e) {
		e.preventDefault();
		var hasclass = $('body').hasClass('pat-res-no-code');
		$(this).html((hasclass ? 'Hide Code' : 'Show Code'));
		$('body').toggleClass('pat-res-no-code');
	});
	
	// Implement live scrolling when clicking on menu links
	$('.pat-res-nav #main-menu a, .pat-res-nav a.brand, .pat-res-btt').click(function(e) {
		e.preventDefault();
		var menuTarget = $(this).attr('href');
		scrollToAnchor(menuTarget);
	});
	
	// Menu Toggle on smaller screens
	$('.pat-res-nav .btn-navbar').click(function() {
		$('pat-res-nav .nav-collapse').toggleClass('collapse');
	});
	
	// Implement Search
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

	$('.pat-res-source .code a.clip').click(function(e){
		e.preventDefault();
		$(this).parent('div').find('pre').select();
	});

	$('.code pre').click(function() {
    $(this).selectText();
  });
  $('.code').click(function() {
    $(this).find('pre').selectText();
  });

	function scrollToAnchor(target) {
		//get the top offset of the target anchor
    var target_offset = $(target).offset();
    var target_top = target_offset.top;
    //goto that anchor by setting the body scroll top to anchor top
    $('html, body').animate({scrollTop:target_top}, 500);
	}

	jQuery.fn.selectText = function(){
    var doc = document;
    var element = this[0];
    console.log(this, element);
    if (doc.body.createTextRange) {
        var range = document.body.createTextRange();
        range.moveToElementText(element);
        range.select();
    } else if (window.getSelection) {
        var selection = window.getSelection();        
        var range = document.createRange();
        range.selectNodeContents(element);
        selection.removeAllRanges();
        selection.addRange(range);
    }
	};
		
});


(function($){
	$('#diet-tabs a').click(function (e) {
  			e.preventDefault()
  			$(this).tab('show')
		});
		$('.kcal-tabs a').click(function (e) {
  			e.preventDefault()
  			$(this).tab('show')
		});
	$('#to-scroll').enscroll({
    	verticalTrackClass: 'track1',
    	verticalHandleClass: 'handle1',
    	drawScrollButtons: true,
    	scrollUpButtonClass: 'scroll-up1',
    	scrollDownButtonClass: 'scroll-down1'
});
})(jQuery)
jQuery(document).ready(function($) {
	
	// Change label at the bottom of the customizer preview settings
	$('#customize-footer-actions > button').replaceWith('<div id="devices-preview-text">Devices Preview</div>');
	
	// CD News/Events toggle status logs
	$('#cd_events_expand').on('click', function () {
		$('.cd-events-show').toggle();
	});
	$('#cd_news_expand').on('click', function () {
		$('.cd-news-show').toggle();
	});
	
});
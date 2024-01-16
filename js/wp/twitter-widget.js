// Twitter widget js

jQuery(document).ready(function($) {
	
	function getBaseUrl() {
		var re = new RegExp(/^.*\//);
		return re.exec(window.location.href);
	}
	
	// Add twitter widget styling
	var $iframeHead;

	var twitterStylesTimer = window.setInterval(function(){

		$iframeHead = $("iframe#twitter-widget-0").contents().find('head');

		if( !$('#twitter-widget-styles', $iframeHead).length ){    // If stylesheet does not exist then create it
			$iframeHead.append('<link rel="stylesheet" href="'+getBaseUrl()+'wp-content/themes/cwd_base_2024/css/twitter-widget.css" id="twitter-widget-styles">');
		}
		else if( $('#twitter-widget-styles', $iframeHead).length ){    // If stylesheet exists then quit timer
			clearInterval(twitterStylesTimer);
		}

	}, 200);
	
	// Add twitter widget script, if needed
	var twitterJsTimer = window.setInterval(function(){

		$iframeHead = $("iframe#twitter-widget-0").contents().find('head');

		if( !$('#twitter-widget-js', $iframeHead).length ){ //If our js does not exist then create it
			$iframeHead.append('<script src="'+getBaseUrl()+'wp-content/themes/cwd_base_2024/js/twitter-widget.js" id="twitter-widget-js"></script>');
		}else if( $('#twitter-widget-js', $iframeHead).length ){    //If js exists then quit timer
			clearInterval(twitterJsTimer);
		}

	}, 200);

});
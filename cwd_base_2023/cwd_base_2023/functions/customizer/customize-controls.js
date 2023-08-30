/**
 * Toggle theme logo options based on choices in customizer.
 */

(function() {
	wp.customize.bind( 'ready', function() {

		// Only show logo position and mobile options when logo size is large.
		wp.customize( 'logo_size', function( setting ) {
			wp.customize.control( 'logo_position', function( control ) {
				var visibility = function() {
					if ( 'large' === setting.get() ) {
						control.container.slideDown( 180 );
					} else {
						control.container.slideUp( 180 );
					}
				};

				visibility();
				setting.bind( visibility );
			});
			wp.customize.control( 'logo_switch_mobile', function( control ) {
				var visibility = function() {
					if ( 'large' === setting.get() ) {
						control.container.slideDown( 180 );
					} else {
						control.container.slideUp( 180 );
					}
				};

				visibility();
				setting.bind( visibility );
			});
			wp.customize.control( 'logo_switch_red_mobile', function( control ) {
				var visibility = function() {
					if ( 'large' === setting.get() ) {
						control.container.slideUp( 180 );
					}
				};

				visibility();
				setting.bind( visibility );
			});
		});

		// Only show red mobile option when switching to 45px on mobile.
		wp.customize( 'logo_switch_mobile', function( setting ) {
			wp.customize.control( 'logo_switch_red_mobile', function( control ) {
				var visibility = function() {
					if ( 'yes' === setting.get() ) {
						control.container.slideDown( 180 );
					} else {
						control.container.slideUp( 180 );
					}
				};

				visibility();
				setting.bind( visibility );
			});
		});

	});
})();
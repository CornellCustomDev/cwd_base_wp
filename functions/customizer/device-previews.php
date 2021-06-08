<?php

// Adjust Customizer responsive sizes
    if ( ! defined( 'ABSPATH' ) ) exit;

    function cwd_customizer_responsive_sizes() {

        $mobile_margin_left = '-240px'; //Half of -$mobile_width
        $mobile_width = '480px';
        $mobile_height = '840px';

        $tablet_margin_left = '-384px'; //Half of -$tablet_width
        $tablet_width = '992px';
        $tablet_height = '840px';

?>
        <style>
            .wp-customizer .preview-mobile .wp-full-overlay-main {
                margin-left: <?php echo $mobile_margin_left; ?>;
                width: <?php echo $mobile_width; ?>;
                height: <?php echo $mobile_height; ?>;
            }

            .wp-customizer .preview-tablet .wp-full-overlay-main {
                margin-left: <?php echo $tablet_margin_left; ?>;
                width: <?php echo $tablet_width; ?>;
                height: <?php echo $tablet_height; ?>;
            }
        </style>
<?php

    }

    add_action( 'customize_controls_print_styles', 'cwd_customizer_responsive_sizes' );

?>
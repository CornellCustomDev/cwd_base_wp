<?php

// Modify the default WordPress gallery output
if ( ! function_exists( 'cwd_image_gallery' ) ) {
    function cwd_image_gallery($output, $attr) {
        
        global $post;

        if (isset($attr['orderby'])) {
            $attr['orderby'] = sanitize_sql_orderby($attr['orderby']);
            if (!$attr['orderby'])
                unset($attr['orderby']);
        }

        extract(shortcode_atts(array(
            'order' => 'ASC',
            'orderby' => 'menu_order ID',
            'id' => $post->ID,
            'itemtag' => 'dl',
            'icontag' => 'dt',
            'captiontag' => 'dd',
            'columns' => 3,
            'size' => 'thumbnail',
            'include' => '',
            'exclude' => ''
        ), $attr));

        $id = intval($id);
        if ('RAND' == $order) $orderby = 'none';

        if (!empty($include)) {
            $include = preg_replace('/[^0-9,]+/', '', $include);
            $_attachments = get_posts(array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));

            $attachments = array();
            foreach ($_attachments as $key => $val) {
                $attachments[$val->ID] = $_attachments[$key];
            }
        }

        if (empty($attachments)) return '';
        
        $columns = intval($columns);
        //$itemwidth = $columns > 0 ? floor(100/$columns) : 100;
            
        // Output
        $output = "<div class=\"cwd-gallery gallery gallery-columns-{$columns} grid\" role=\"region\" aria-label=\"Image Gallery\">\n";
        $output .= "<div class=\"thumbnails flex\">\n";

        // Loop through images
        foreach ($attachments as $id => $attachment) {
            $img = wp_get_attachment_image_src($id, 'full');
            $thumb = wp_get_attachment_image_src($id, 'medium');
            $alt = get_post_meta($id, '_wp_attachment_image_alt', true);
            $caption = $attachment->post_excerpt;
            $label = $alt;
            if (!empty($caption)) {
                if (!empty($alt)) {
                    $label = $label . ', Caption: ';
                }
                $label = $label . $caption;
            }
            //$description = $attachment->post_content;
            //$image_title = $attachment->post_title;
            $page_title = $post->post_name;
            
            $output .= "<div class=\"gallery-item col\">\n";
            $output .= "<a class=\"popup\" role=\"img\" href=\"{$img[0]}\" data-gallery=\"{$page_title}\" data-title=\"{$caption}\" data-alt=\"{$alt}\" aria-label=\"{$label}\">\n";
            $output .= "<h3 class=\"sr-only\">{$caption}</h3>\n";
            $output .= "<img src=\"{$thumb[0]}\" alt=\"{$alt}\" />\n";
            $output .= "</a>\n";
            $output .= "</div>\n";
        }

        $output .= "</div>\n";
        $output .= "</div>\n";
        
        return $output;
    }
    add_filter('post_gallery', 'cwd_image_gallery', 10, 2);
}
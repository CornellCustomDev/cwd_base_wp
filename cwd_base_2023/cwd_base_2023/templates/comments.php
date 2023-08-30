<?php

// Comments template
if ( post_password_required() )
    return;
?>
 
<section id="comments" class="comments-area">
 
    <?php if ( have_comments() ) : ?>
	
        <h2 class="comments-title">
            <?php
                printf( _nx( 'One thought on "%2$s"', '%1$s thoughts on "%2$s"', get_comments_number(), 'comments title', 'cwd_base' ),
                    number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
            ?>
        </h2>
 
        <ol class="comment-list">
            <?php
                wp_list_comments( array(
                    'style'       => 'ul',
                    'short_ping'  => true,
                    'avatar_size' => 74
                ) );
            ?>
        </ol>
 
        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
	
			<?php if( function_exists('cwd_pagination_comments') ) cwd_pagination_comments(); ?>
	
        <?php endif; ?>
 
        <?php if ( ! comments_open() && get_comments_number() ) : ?>
	
        	<p class="no-comments"><?php _e( 'Comments are closed.' , 'cwd_base' ); ?></p>
	
        <?php endif; ?>
 
    <?php endif; ?>
	
    <?php comment_form(); ?>
 
</section>
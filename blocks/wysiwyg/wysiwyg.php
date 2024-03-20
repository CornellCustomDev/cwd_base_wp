<?php $classes = array( 'formatted-text', $block['className'] ?? null ); ?>

<?php if ( $text = get_field('wysiwyg_text') ): ?>
	<div class="<?php echo implode( ' ', array_filter( $classes ) ); ?>">
		<?php echo $text; ?>
	</div>
<?php endif; ?>

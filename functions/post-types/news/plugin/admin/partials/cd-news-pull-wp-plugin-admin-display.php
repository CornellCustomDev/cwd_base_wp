<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://github.com/CU-CommunityApps
 * @since      1.0.0
 *
 * @package    Cd_News_Pull_Wp_Plugin
 * @subpackage Cd_News_Pull_Wp_Plugin/admin/partials
 */

?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<div>
	<h2><img src='//www.cornell.edu/favicon.ico' alt=''> CD News Logs and General Instructions</h2>
	<p>
		This plugin was created by  <b >Cornell Custom Development</b>. For support contact <a href='mailto:iws-support@cornell.edu'>iws-support@cornell.edu</a>
	</p>
	<h3>Status</h3>
	<p>

		<?php
		$logs = get_option( 'cd_news_status_log' );
		if ( is_array( $logs ) ) {
			$last_ran = array_shift( $logs );
			echo '<div>' . esc_html( $last_ran ) . '</br></br><button id="cd_news_expand">Toggle Display of Status Logs</button></div>';
			echo( '<div class="cd-news-show" hidden><ul>' );
			foreach ( $logs as $log ) {
				if ( is_array( $log ) || is_object( $log ) ) {
					$log = wp_json_encode( $log );
				}
				echo( '<li>' . esc_html( $log ) . '</li>' );
			}
			echo( '</ul></div> </br><hr>');
		} else {
			echo( 'ERROR No Status Available!' );
		}
		?>
	</p>
	<h3>Instructions</h3>
	<p>
		Pulls news from the CU News (<a href='https://news.cornell.edu/rss-feeds'>https://news.cornell.edu/rss-feeds</a>). Only supports [JSON] feed and saves it to a WordPress custom content type.
		Use the settings tab to controll how data is pulled, and loaded into WP custom content fields.
	</p>
	<p>
		Use the settings page to configure. Extraction settings these are the fields to configure the Pull from cunews. Transform settings map the news data fields below to the custom content data fields. Load options are WordPress save/update configuartion options.
	</p>
	<p>
		<h4>CU News Available Data Fields:</h4>
		<ul>
			<li>id </li>
			<li>url </li>
			<li>title </li>
			<li>content_text </li>
			<li>image </li>
			<li>image_1x1 </li>
			<li>date_published </li>
			<li>image_featured </li>
			<li>image_alt </li>
		</ul>
	<p>

</div>

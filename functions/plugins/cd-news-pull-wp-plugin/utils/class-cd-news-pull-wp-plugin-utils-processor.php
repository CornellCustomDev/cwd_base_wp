<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/CU-CommunityApps
 * @since      1.0.0
 *
 * @package    Cd_News_Pull_Wp_Plugin
 * @subpackage Cd_News_Pull_Wp_Plugin/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Cd_News_Pull_Wp_Plugin
 * @subpackage Cd_News_Pull_Wp_Plugin/admin
 * @author     psw58 <psw58@cornell.edu>
 */
class Cd_News_Pull_Wp_Plugin_Utils_Processor {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      array    $status_log Records some data about the news pull.
	 */
	private $status_log;

	/**
	 * The name option name of the log.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $log_option the name of the variable to hold.
	 */
	static $log_option = 'cd_news_status_log';

	/**
	 * The name option name of the log.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $log_option the name of the variable to hold.
	 */
	static $toggle = 'cd_news_toggle_url';

	/**
	 * The key(name) for the timer.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $transient_timer_key
	 */
	static $transient_timer_key = 'cd-news-wp-pull';

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string $plugin_name       The name of this plugin.
	 * @param      string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->status_log = [];
		add_option( self::$log_option, $this->status_log );
	}

	/**
	 * Sets a timer when the timer expires reloads the news data.
	 *
	 * Consider replacing with CRON clock.
	 * Consider storing to plugin database instead of temporary.
	 */
	public function cd_news_pull_get_cron_timer() {
		$this->write_log( 'cd_news_pull_get_cron_timer started' );
		$date = current_time( 'timestamp' );
		$date_str  = date( 'D M d, Y G:i', $date );
		$this->write_log( 'Info: Last Ran: ' . $date_str );
		$this->cd_news_pull();
	}

	/**
	 * Use this to test with timer on lacal development.
	 *
	 * Consider replacing with CRON clock.
	 * Consider storing to plugin database instead of temporary.
	 */
	public function cd_news_pull_loaded_timer() {
		$this->write_log( 'cd_news_pull_get_cron_timer started' );
		$data = get_transient( self::$transient_timer_key );
		// Get the timer interval from settings.
		$experation = get_option( 'cd_news_pull_timer' );
		if ( empty( $data ) ) {
			// Get the wp datetime.
			$date  = current_time( 'timestamp' );
			$date  = date( 'D M d, Y G:i', $date );
			$this->write_log( 'Info: Last Ran: ' . $date );
			set_transient( self::$transient_timer_key, $date , $experation );
			$this->cd_news_pull();
		}
	}

	/**
	 * ETL of news from API.
	 */
	private function cd_news_pull() {
		$this->write_log( 'Notice: Starting extract news from JSON feed.' );
		$news_response = $this->cd_extract_news();
		if ( empty( $news_response ) || ! is_array( $news_response ) ) {
			$this->write_log( 'Warning: no news recieved from JSON feed.' );
			return $news_response;
		}
		if ( array_key_exists( 'error', $news_response ) ) {
			$this->write_log( 'Warning: no news recieved from JSON feed.' );
			return $news_response;
		};
		$this->write_log( 'Notice: Starting transform news data.' );
		$t_news = $this->cd_transform_news( $news_response );
		$this->write_log( 'Notice: Starting load of news data to WordPress.' );
		$this->cd_load_news( $t_news );
		$this->write_log( 'Notice: Successfully Completed.' );
	}

	/**
	 * Fetches a url endpoint.
	 *
	 * @param string $url The url to fetchj.
	 */
	private function get_url( string $url ) {
		$response = wp_safe_remote_get( $url );
		if ( ! is_array( $response ) || is_wp_error( $response ) ) {
			$this->write_log( 'Warning: in url_1' . wp_json_encode( $response ) );
			return (object) [
				'error' => $response,
			];
		}
		return json_decode( $response['body'] );
	}

	/**
	 * Extracts the news data.
	 */
	private function cd_extract_news() {
		// A comma seperated list of department ids.
		$url_1 = get_option( 'cd_news_pull_url_1' );
		$url_2 = get_option( 'cd_news_pull_url_2' );
		// Url_1 is required.
		if ( empty( $url_1 ) ) {
			$this->write_log( 'Warning url 1 is required' );
			return;
		}

		if ( empty( $url_2 ) ) {
			return $this->get_url( $url_1 );
		}

		// There are two urls.
		$selected_url = get_option( self::$toggle );
		if ( ! $selected_url ) {
			$this->write_log( 'Notice: Init Toggle url' );
			add_option( self::$toggle, 'url_1' );
			return $this->get_url( $url_1 );
		} elseif ( 'url_1' === $selected_url ) {
			$this->write_log( 'Info: TOGGLE Loading url_1 data' );
			update_option( self::$toggle, 'url_2' );
			return $this->get_url( $url_1 );
		} elseif ( 'url_2' === $selected_url ) {
			$this->write_log( 'Info: TOGGLE Loading url_2 data' );
			update_option( self::$toggle, 'url_1' );
			return $this->get_url( $url_2 );
		} else {
			$this->write_log( 'Error: url option returned false' );
		}

	}

	/**
	 * Restructure news data.
	 * Shouldnt we validate the structure here?
	 *
	 * @param array $news_response The news fetched from cornell calendar.
	 */
	private function cd_transform_news( $news_response ) {
		if ( empty( $news_response ) ) {
			$this->write_log( 'Warning: Transform recieved null data' );
			return;
		}
		$post_type = get_option( 'cd_news_pull_post_type' );
		if ( empty( $post_type ) ) {
			$this->write_log( 'Warning: Custom post type is required' );
			return;
		}
		$title       = get_option( 'cd_news_pull_title' );
		$cu_news_id  = get_option( 'cd_news_pull_news_id' ) ?: 'cu_news_id';
		$news_url    = get_option( 'cd_news_pull_news_url' ) ?: 'cu_news_url';
		$date        = get_option( 'cd_news_pull_date_published' ) ?: 'publication_date';
		$description = get_option( 'cd_news_pull_content_text' ) ?: 'content_text';
		$image_url   = get_option( 'cd_news_pull_image' ) ?: 'image';
		$image_alt   = get_option( 'cd_news_pull_image_alt' ) ?: 'image_alt';
		$filter_tags = explode( ',', get_option( 'cd_news_pull_filter_tags' ) );
		$publish     = get_option( 'cd_news_pull_is_publish' ) ? 'publish' : 'draft';
		$t_news      = [];
		$this->write_log( 'Notice: Starting filter by tags.' );
		foreach ( $news_response as $e ) {
			$is_loadable = ( empty( $filter_tags ) ) ?: false;
			foreach ( $filter_tags as $tag ) {
				if ( $this->in_arrayi( trim( $tag ), $e->tags ) ) {
					$is_loadable = true;
					// $this->write_log( 'Debug: Found ' . $tag . ' in ' . wp_json_encode( $e->tags ) );
					break;
				}
			}
			if ( $is_loadable ) {
				$t = (object) [
					'post_content' => $e->content_text,
					'post_title' => $e->title,
					'post_type' => $post_type,
					'post_author' => 1,
					'post_status' => $publish,
					'meta_input' => [
						$cu_news_id => $e->id,
						$news_url => $e->url,
						$title => $e->title,
						$description => $e->content_text,
						$image_url => $e->image_featured ?: '',
						$image_alt => ( ! empty( $e->image_alt ) ) ? $e->image_alt : '',
						$date => $e->date_published,
					],
				];
				array_push( $t_news, $t );
			} else {
				// $this->write_log( 'Debug: News feed is missing tag ignoring ' . $e->title . ' with tags ' . wp_json_encode( $e->tags ) );
			}
		}
		return $t_news;
	}

	/**
	 * Loads the news into WordPress.
	 *
	 * @param array $t_news_array The news ready to load.
	 */
	private function cd_load_news( $t_news_array ) {
		$post_type = get_option( 'cd_news_pull_post_type' );
		$taxonomy  = get_option( 'cd_news_pull_category' );
		$term      = get_option( 'cd_news_pull_tag_id' );
		$term_data = term_exists( $term, $taxonomy );
		$news_id   = get_option( 'cd_news_pull_news_id' ) ?: 'cu_news_id';
		if ( ! empty( $term_data ) ) {
			$this->write_log( [ 'Notice: Setting default category term ', $term_data['term_id'] ] );
		}

		foreach ( $t_news_array as $t_news ) {
			$args = [
				'numberposts' => -1,
				'post_type' => $post_type,
				'meta_key'  => $news_id,
				'meta_value' => $t_news->meta_input[ $news_id ],
				'post_status' => 'any',
			];
			$news_query = new WP_Query( $args );
			if ( $news_query->found_posts == 1 ) {
				continue;
			} else if ( $news_query->found_posts > 1 ) {
				$this->write_log( 'WARNING: Found multiple posts with the same ID! ' . $t_news->meta_input[ $news_id ] );
			} elseif ( ! $news_query->have_posts() ) {

				$post_id = wp_insert_post( $t_news );
				if ( ! empty( $term_data ) ) {
					wp_set_post_terms( $post_id, [ $term_data['term_id'] ], $taxonomy );
				}
				$this->write_log( 'Notice: Created New News Article: ' . $t_news->post_title . ' ID:' . $post_id );
			}
		}
	}

	/**
	 * Writes to the error logger
	 *
	 * @param mixed $log The content to log.
	 */
	private function write_log( $log ) {
		if ( is_array( $log ) || is_object( $log ) ) {
			$log = wp_json_encode( $log );
		}
		array_push( $this->status_log, $log );
		update_option( self::$log_option, $this->status_log );
		if ( true === WP_DEBUG ) {
			error_log( $log );
		}
	}

	/**
	 * Helper function checkes case insensitive
	 *
	 * @param string $needle The search string.
	 * @param array  $haystack The array to be searched.
	 */
	private function in_arrayi( string $needle, array $haystack ) {
		return in_array( strtolower( $needle ), array_map( 'strtolower', $haystack ), true );
	}

}

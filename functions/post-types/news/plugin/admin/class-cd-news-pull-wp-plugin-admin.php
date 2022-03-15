<?php
/**
 * The admin-specific functionality of the plugin.
 * hat tip https://github.com/wplauncher/settings-page/issues
 *
 * @link       https://github.com/CU-CommunityApps
 * @since      1.0.0
 *
 * @package    Cd_News_Pull_Wp_Plugin
 * @subpackage Cd_News_Pull_Wp_Plugin/admin
 */

// Required for timer name that is reset on form save.
require_once plugin_dir_path( dirname( __FILE__ ) ) . 'utils/class-cd-news-pull-wp-plugin-utils-processor.php';

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
class Cd_News_Pull_Wp_Plugin_Admin {

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
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string $plugin_name       The name of this plugin.
	 * @param      string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script(
			$this->plugin_name,
			plugin_dir_url( __FILE__ ) . 'js/cd-news-pull-wp-plugin-admin.js',
			[ 'jquery' ],
			$this->version,
			true
		);

	}

	/**
	 * Adds the plugin to the admin menu.
	 */
	public function add_plugin_admin_menu() {
		add_menu_page(
			$this->plugin_name,
			'CD News',
			'administrator',
			$this->plugin_name,
			[ $this, 'display_plugin_admin_dashboard' ],
			'dashicons-analytics',
			26
		);
		add_submenu_page(
			$this->plugin_name,
			'CD News',
			'Settings',
			'administrator',
			$this->plugin_name . '-settings',
			[ $this, 'display_plugin_admin_settings' ],
		);
	}

	/**
	 * Loads the template.
	 */
	public function display_plugin_admin_dashboard() {
		require_once 'partials/' . $this->plugin_name . '-admin-display.php';
	}

	/**
	 * Display the settings page in admin tool bar.
	 */
	public function display_plugin_admin_settings() {
		// Set this var to be used in the settings-display view.
		$active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'general';
		if(isset($_GET['error_message'])){
			add_action('admin_notices', [ $this, 'pluginNameSettingsMessages'] );
			do_action( 'admin_notices', $_GET['error_message'] );
		}
		require_once 'partials/'.$this->plugin_name.'-admin-settings-display.php';
	}

	public function pluginNameSettingsMessages( $error_message ){
		switch ($error_message) {
			case '1':
				// Currently not supported @todo add a error message status.
				$message = __( 'There was an error adding this setting. Please try again.  If this persists, shoot us an email.', 'my-text-domain' );
				break;
		}
		$type = 'error';
		add_settings_error(
			   $setting_field,
			   $err_code,
			   $message,
			   $type
		   );
	}

	/**
	 * Build the settings form.
	 */
	public function register_and_build_fields() {
		// reset the clock to force rerun
		if( isset( $_POST['cd_news_reset_hidden_field'] ) ) {
			$transient_key = Cd_News_Pull_Wp_Plugin_Utils_Processor::$transient_timer_key;
			set_transient($transient_key, false);
		}
		/**
		 * First, we add_settings_section. This is necessary since all future settings must belong to one.
		 * Second, add_settings_field
		 * Third, register_setting
		 */
		add_settings_section(
			// ID used to identify this section and with which to register options
			'cd_news_pull_general_section',
			// Title to be displayed on the administration page
			'News Article Pull Section(Extract):',
			// Callback used to render the description of the section
			function(){
				echo ( 'Configure settings to extract JSON data from CU News URL.');
			},
			// Page on which to add this section of options
			'cd_news_pull_general_settings'
		);

		// News URL
		$this->cd_news_pull_add_settings_field(
			'URL for CU News JSON feed *',
			[
				'id' => 'cd_news_pull_url_1',
				'required' => 'required',
				'help_text' => 'Example: https://news.cornell.edu/taxonomy/term/14242/json'
			]
		);

		// News URL2
		$this->cd_news_pull_add_settings_field(
			'URL for Second CU News JSON feed',
			[
				'id' => 'cd_news_pull_url_2',
				'help_text' => '(optional) Can pull up to two different news feeds'
			]
		);

		// Tags filter
		$this->cd_news_pull_add_settings_field(
			'Filter by Tags',
			[
				'id' => 'cd_news_pull_filter_tags',
				'help_text' => 'Filter news results by a comma seperated list of tags (this are joining tags the more tags you have the more results you will see). Example: research,health"'
			]
		);

		// Frequency Field
		$this->cd_news_pull_add_settings_field(
			'Pull Frequency in seconds ',
			[
				'id' => 'cd_news_pull_timer',
				'help_text' => 'Increase this number to greatly improve performance. 1hour = (60x60) = 3600 seconds. Math is fun 😊',
				'subtype' => 'number',
				'min_value' => 3600,
				'max_value' => 86400,
				'step' => 3600,
				// 'min_value' => 30,
				// 'max_value' => 86400,
				// 'step' => 30,
				'required' => 'required'
			],
		);

		add_settings_section(
			'cd_news_pull_fields_section',
			'Field Mapping Section (Transform):',
			function(){
				echo ( 'Use this section to map News fields to Custom content fields (Transform).');
			},
			'cd_news_pull_general_settings'
		);

		// Post type
		$this->cd_news_pull_add_settings_field(
			'Custom Post Type *',
			[
				'id' => 'cd_news_pull_post_type',
				'help_text' => 'The Slug name of the Custom Post Type.',
				'required' => 'required',
				'section' => 'cd_news_pull_fields_section',
			],
		);

		// ID Field
		$this->cd_news_pull_add_settings_field(
			'Field to store the CU News ID field ',
			[
				'id' => 'cd_news_pull_news_id',
				'section' => 'cd_news_pull_fields_section',
			],
		);

		// News Url
		$this->cd_news_pull_add_settings_field(
			'News Url Field for Custom Post',
			[
				'id' => 'cd_news_pull_news_url',
				'help_text' => 'The url to link to the main article.',
				'section' => 'cd_news_pull_fields_section',
			]
		);

		// Title Field
		$this->cd_news_pull_add_settings_field(
			'Title Field of Custom Post',
			[
				'id' => 'cd_news_pull_title',
				'section' => 'cd_news_pull_fields_section',
			],
		);

		// Content Summary
		$this->cd_news_pull_add_settings_field(
			'Content Summary Field for Custom Post',
			[
				'id' => 'cd_news_pull_content_text',
				'help_text' => 'CU News only provides a summary and not full articles',
				'section' => 'cd_news_pull_fields_section',
			]
		);

		// Image Field
		$this->cd_news_pull_add_settings_field(
			'Image Field of Custom Post ',
			[
				'id' => 'cd_news_pull_image',
				'help_text' => 'The URL of the image hosted on CU News',
				'section' => 'cd_news_pull_fields_section',
			],
		);

		// Image alt text
		$this->cd_news_pull_add_settings_field(
			'Image Alt Text Field of Custom Post ',
			[
				'id' => 'cd_news_pull_image_alt',
				'section' => 'cd_news_pull_fields_section',
			],
		);

		// Date Field
		$this->cd_news_pull_add_settings_field(
			'Date Field of Custom Post',
			[
				'id' => 'cd_news_pull_date_published',
				'section' => 'cd_news_pull_fields_section',
			],
		);

		// Publising Options
		add_settings_section(
			'cd_news_pull_publishing_section',
			'Publishing Options Section (Load):',
			function(){
				echo ( '');
			},
			'cd_news_pull_general_settings'
		);

		// Publish Field
		$this->cd_news_pull_add_settings_field(
			'Publish all new News content ',
			[
				'id' => 'cd_news_pull_is_publish',
				'subtype' => 'checkbox',
				'section' => 'cd_news_pull_publishing_section',
			],
		);

		// Default Category
		$this->cd_news_pull_add_settings_field(
			'Default Categories slug name of Custom Post',
			[
				'id' => 'cd_news_pull_category',
				'section' => 'cd_news_pull_publishing_section',
				'help_text' => 'The default category slug',
			],
		);

		// Default Category
		$this->cd_news_pull_add_settings_field(
			'Default Tag slug name of Custom Post',
			[
				'id' => 'cd_news_pull_tag_id',
				'section' => 'cd_news_pull_publishing_section',
				'help_text' => 'The default taxonomy to set requires Category',
			],
		);

		register_setting( 'cd_news_pull_general_settings', 'cd_news_pull_url_1');
		register_setting( 'cd_news_pull_general_settings', 'cd_news_pull_url_2');
		register_setting( 'cd_news_pull_general_settings', 'cd_news_pull_filter_tags');
		register_setting( 'cd_news_pull_general_settings', 'cd_news_pull_post_type');
		register_setting( 'cd_news_pull_general_settings', 'cd_news_pull_news_id');
		register_setting( 'cd_news_pull_general_settings', 'cd_news_pull_news_url');
		register_setting( 'cd_news_pull_general_settings', 'cd_news_pull_title');
		register_setting( 'cd_news_pull_general_settings', 'cd_news_pull_content_text');
		register_setting( 'cd_news_pull_general_settings', 'cd_news_pull_image');
		register_setting( 'cd_news_pull_general_settings', 'cd_news_pull_image_alt');
		register_setting( 'cd_news_pull_general_settings', 'cd_news_pull_date_published');
		register_setting( 'cd_news_pull_general_settings', 'cd_news_pull_is_publish');
		register_setting( 'cd_news_pull_general_settings', 'cd_news_pull_timer');
		register_setting( 'cd_news_pull_general_settings', 'cd_news_pull_category');
		register_setting( 'cd_news_pull_general_settings', 'cd_news_pull_tag_id');
	}

	/**
	 * Wrapper for add_settings_field sets some defaults.
	 *
	 * @param string $label The input label
	 * @param array  $args  Additional Args.
	 */
	public function cd_news_pull_add_settings_field( String $label, Array $args ) {
		$section = ( ! empty( $args['section']) ? $args['section'] : 'cd_news_pull_general_section' );
		add_settings_field(
			$args['id'],
			$label,
			[ $this, 'cd_news_pull_render_settings_field' ],
			'cd_news_pull_general_settings',
			$section,
			$args,
		);
	}

	/**
	 * Renders the form input.
	 *
	 * EXAMPLE INPUT
	 * 'type'      => 'input',
	 * 'subtype'   => '',
	 * 'id'    => $this->plugin_name.'_example_setting',
	 * 'name'      => $this->plugin_name.'_example_setting',
	 * 'required' => 'required="required"',
	 * 'get_option_list' => "",
	 * 'value_type' = serialized OR normal,
	 * 'wp_data'=>(option or post_meta),
	 * 'post_id' =>
	 *
	 * @param array $args Available seetings.
	 */
	public function cd_news_pull_render_settings_field($args) {
		// Set up Defaults.
		if ( empty( $args['name'] ) ) {
			$args['name'] = $args['id'];
		}

		if ( empty( $args['wp_data'] ) ) {
			$args['wp_data'] = 'option';
		}

		if ( empty( $args['value_type'] ) ) {
			$args['value_type'] = 'normal';
		}

		if ( empty( $args['required'] ) ) {
			$args['required'] = '';
		}

		if ( empty( $args['subtype'] ) ) {
			$args['subtype'] = 'text';
		}

		if ( empty( $args['type'] ) ) {
			$args['type'] = 'input';
		}

		if ( empty( $args['min_value'] ) ) {
			$args['min_value'] = '';
		} else {
			$args['min_value'] = "min=" . $args['min_value'] . " step=" . $args['step'] . " max=" . $args['max_value'];
		}

		if($args['wp_data'] == 'option'){
			$wp_data_value = get_option($args['name']);
		} elseif($args['wp_data'] == 'post_meta'){
			$wp_data_value = get_post_meta($args['post_id'], $args['name'], true );
		}

		switch ($args['type']) {
			case 'input':
				$value = ($args['value_type'] == 'serialized') ? serialize($wp_data_value) : $wp_data_value;
				if( $args['subtype'] != 'checkbox' ) {
					echo '<input type="'.$args['subtype'].'" ' . $args['min_value'] . '  id="'.$args['id'].'" '.$args['required'].' name="'.$args['name'].'" size="40" value="' . esc_attr($value) . '" />';
				} else {
					$checked = ($value) ? 'checked' : '';
					echo '<input type="'.$args['subtype'].'" id="'.$args['id'].'" '.$args['required'].' name="'.$args['name'].'" size="40" value="1" '.$checked.' />';
				}
				if ( ! empty($args['help_text']) ) {
					echo "<p class='help-text'>" . $args['help_text'] . "</p>";
				}
				break;
			default:
				break;
		}
	}

}

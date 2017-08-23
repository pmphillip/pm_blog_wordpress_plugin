<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://pmagentur.com/
 * @since      1.0.0
 *
 * @package    Pm_Example
 * @subpackage Pm_Example/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Pm_Example
 * @subpackage Pm_Example/admin
 * @author     Waldemar Schiller <waldemar.schiller@pmagentur.com>
 */
class Pm_Example_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
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

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Pm_Example_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Pm_Example_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/pm-example-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Pm_Example_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Pm_Example_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/pm-example-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Register the settings page in admin area.
	 *
	 * @since    1.0.0
	 */
	public function add_settings_page(){
		add_plugins_page(
			'The P&M example settings page',
			'P&M Example Settings',
			'manage_options',
			$this->plugin_name,
			array( $this, 'display_settings_page' ) );
	}

	/**
	 * Display the settings page in admin area.
	 *
	 * @since    1.0.0
	 */
	public function display_settings_page(){
		?>
		<div class="wrap">
			<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
			<?php settings_errors(); ?>
			<form action="options.php" method="post">
				<?php
				settings_fields( 'pm_example_settings_group' );

				do_settings_sections( 'pm_example_settings_group' );

				submit_button( 'Save Settings' );
				?>
			</form>
		</div>
		<?php
	}

	/**
	 * Register all the settings, fields and sections.
	 *
	 * @since    1.0.0
	 */
	public function add_settings(){
		// Create the option first if not done already.
		add_option( 'pm_example_settings_group' );

		// add settings section for post-type
		add_settings_section(
			'pm_example_posttype_section',
			'Inhaltstyp',
			array( $this, 'render_settings_section' ),
			'pm_example_settings_group'
		);

		// add the field for a post-type input
		add_settings_field(
			'slider_posttype',
			'Inhaltstyp für den Slider',
			array( $this, 'render_text_input' ),
			'pm_example_settings_group',
			'pm_example_posttype_section',
			array(
				'option'    => 'slider_posttype'
			)
		);

		// add settings section for automatic sliding behaviour
		add_settings_section(
			'pm_example_autoslide_section',
			'Automatisches Sliden',
			array( $this, 'render_settings_section' ),
			'pm_example_settings_group'
		);

		// add the field for a automatic slide checkbox
		add_settings_field(
			'do_automatic_slide',
			'Automatisches Sliden aktivieren',
			array( $this, 'render_checkbox_input' ),
			'pm_example_settings_group',
			'pm_example_autoslide_section',
			array(
				'option'    => 'do_automatic_slide'
			)
		);

		// add the field for automatic slide interval
		add_settings_field(
			'automatic_slide_interval',
			'Intervall des automatischen Slidens in ms',
			array( $this, 'render_text_input' ),
			'pm_example_settings_group',
			'pm_example_autoslide_section',
			array(
				'option'    => 'automatic_slide_interval'
			)
		);

		// register all sections and fields in WP
		register_setting(
			'pm_example_settings_group',
			'pm_example_settings_name'
		);
	}

	/**
	 * Renders additional content for settings section.
	 *
	 * @since    1.0.0
	 */
	public function render_settings_section() {
	//echo additional content between section header and content
	}

	/**
	 * Renders input for a text field.
	 *
	 * This uses the parameter exposed to the callback of add_settings_field to get the option name.
	 *
	 * @since    1.0.0
	 */
	public function render_text_input( $args ) {
		$options = get_option( 'pm_example_settings_name' );
		$value = ( isset( $options[ $args['option'] ] )? $options[ $args['option'] ] : '' );
		$html = '<input type="text" id="pm_example_settings_name['. $args['option'] .']" name="pm_example_settings_name['. $args['option'] .']" value="'. $value .'"/>';

		echo $html;
	}

	/**
	 * Renders input for a checkbox field.
	 *
	 * This uses the parameter exposed to the callback of add_settings_field to get the option name.
	 *
	 * @since    1.0.0
	 */
	public function render_checkbox_input( $args ) {
		$options = get_option( 'pm_example_settings_name' );
		$value = ( isset( $options[ $args['option'] ] )? $options[ $args['option'] ] : '0' );
		$html = '<input type="checkbox" id="pm_example_settings_name['. $args['option'] .']" name="pm_example_settings_name['. $args['option'] .']" value="1" '.checked(1, $value, false).'>';

		echo $html;
	}

}

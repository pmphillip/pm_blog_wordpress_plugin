<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://pmagentur.com/
 * @since             1.0.0
 * @package           Pm_Example
 *
 * @wordpress-plugin
 * Plugin Name:       PM Example
 * Plugin URI:        https://pmagentur.com/
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Waldemar Schiller
 * Author URI:        https://pmagentur.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       pm-example
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-pm-example-activator.php
 */
function activate_pm_example() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-pm-example-activator.php';
	Pm_Example_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-pm-example-deactivator.php
 */
function deactivate_pm_example() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-pm-example-deactivator.php';
	Pm_Example_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_pm_example' );
register_deactivation_hook( __FILE__, 'deactivate_pm_example' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-pm-example.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_pm_example() {

	$plugin = new Pm_Example();
	$plugin->run();

}
run_pm_example();

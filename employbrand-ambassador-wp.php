<?php
/**
 * Plugin Name: Employbrand Ambassador
 * Plugin URI: https://employbrand.nl
 * Description: Employbrand Ambassador Wordpress plugin for Click Tracking.
 * Version: 1.0.1
 * Author: Employbrand B.V.
 * Author URI: https://employbrand.nl
 * License: GPL2
 */

require plugin_dir_path( __FILE__ ) . 'vendor/autoload.php';

new EmploybrandAmbassador\Plugin();

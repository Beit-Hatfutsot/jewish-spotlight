<?php
/**
 * Bootstrap file for setting the ABSPATH constant
 * and load the Jewish Spotlight environment
 *
 * @author		Nir Goldberg
 * @package		jewish-spotlight
 * @version		1.0
 */

/**
 * Define ABSPATH as this file's directory
 */
define( 'ABSPATH', dirname(__FILE__) . '/' );

// Include files required for initialization
define( 'BHJS_INC', 'bhjs-includes' );
require( ABSPATH . BHJS_INC . '/default-constants.php' );

// Defines initial constants
bhjs_initial_constants();

// Defines templating related constants
bhjs_templating_constants();

// Load the functions for the active theme
if ( file_exists( TEMPLATEPATH . '/functions.php' ) )
	include( TEMPLATEPATH . '/functions.php' );
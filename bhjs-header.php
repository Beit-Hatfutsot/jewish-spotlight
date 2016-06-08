<?php
/**
 * Loads the Jewish Spotlight environment and template
 *
 * @author		Nir Goldberg
 * @package		jewish-spotlight
 * @version		1.0
 */

if ( !isset($bhjs_did_header) ) {

	$bhjs_did_header = true;

	// Load the Jewish Spotlight environment
	require_once( dirname(__FILE__) . '/bhjs-load.php' );

	// Load the Jewish Spotlight theme template
	require_once( ABSPATH . BHJS_INC . '/template-loader.php' );

}
<?php
/**
 * Defines constants and global variables
 *
 * @author		Nir Goldberg
 * @package		jewish-spotlight/bhjs-includes
 * @version		1.0
 */

/**
 * Gets current site URL
 *
 * @since		1.0
 * @param		N/A
 * @return		(string)
 */
function bhjs_get_siteurl() {

	$url = @( $_SERVER["HTTPS"] != 'on' ) ? 'http://'.$_SERVER["SERVER_NAME"] :  'https://'.$_SERVER["SERVER_NAME"];

	return $url;

}

/**
 * Defines initial constants
 *
 * @since		1.0
 * @param		N/A
 * @return		N/A
 */
function bhjs_initial_constants() {

	if ( ! defined('BHJS_CONTENT_DIR') )
		define( 'BHJS_CONTENT_DIR', ABSPATH . 'bhjs-content' ); // no trailing slash, full paths only

	if ( ! defined('BHJS_CONTENT_URL') )
		define( 'BHJS_CONTENT_URL', bhjs_get_siteurl() . '/bhjs-content'); // full url

}

/**
 * Defines templating related constants
 *
 * @since		1.0
 * @param		N/A
 * @return		N/A
 */
function bhjs_templating_constants() {

	/**
	 * Slug of the default theme for this install.
	 * Used as the default theme when installing new site.
	 * It will be used as the fallback if the current theme doesn't exist.
	 *
	 * @since 1.0
	 */
	if ( ! defined('BHJS_DEFAULT_THEME') )
		define( 'BHJS_DEFAULT_THEME', 'master' );

	/**
	 * Filesystem path to the current active template directory
	 *
	 * @since 1.0
	 */
	if ( ! defined('TEMPLATEPATH') )
		define( 'TEMPLATEPATH', BHJS_CONTENT_DIR . '/themes/' . BHJS_DEFAULT_THEME );

	/**
	 * Url to the current active template directory
	 *
	 * @since 1.0
	 */
	if ( ! defined('TEMPLATEURL') )
		define( 'TEMPLATEURL', BHJS_CONTENT_URL . '/themes/' . BHJS_DEFAULT_THEME );

}
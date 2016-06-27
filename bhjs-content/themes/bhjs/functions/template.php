<?php
/**
 * Template functions
 *
 * @author		Nir Goldberg
 * @package		jewish-spotlight/bhjs-content/themes/bhjs/functions
 * @version		1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * get_header
 *
 * Displays header
 *
 * @since		1.0
 * @param		N/A
 * @return		N/A
 */
function get_header() {

	include( TEMPLATEPATH . '/header.php' );

}

/**
 * get_footer
 *
 * Displays footer
 *
 * @since		1.0
 * @param		N/A
 * @return		N/A
 */
function get_footer() {

	include( TEMPLATEPATH . '/footer.php' );

}

/**
 * get_page_template
 *
 * Loads and displays page template
 *
 * @since		1.0
 * @param		N/A
 * @return		N/A
 */
function get_page_template() {

	$page_template = bhjs_core()->get_attribute('page_template');

	if ( $page_template && file_exists( TEMPLATEPATH . '/template/' . $page_template ) ) {
		include( TEMPLATEPATH . '/template/' . $page_template );
	}

}
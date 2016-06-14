<?php
/**
 * Template functions
 *
 * @author		Nir Goldberg
 * @package		jewish-spotlight/bhjs-content/themes/master/functions
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
 * get_main_page_template
 *
 * Displays main page template
 *
 * @since		1.0
 * @param		N/A
 * @return		N/A
 */
function get_main_page_template() {

	include( TEMPLATEPATH . '/view/page/main.php' );

}
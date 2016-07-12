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

	$page_template = bhjs_core()->get_attribute( 'page_template' );

	if ( $page_template && file_exists( TEMPLATEPATH . '/template/' . $page_template ) ) {
		include( TEMPLATEPATH . '/template/' . $page_template );
	}

}

/**
 * get_data_type_template
 *
 * Loads and displays data type template
 *
 * @since		1.0
 * @param		$type (string) data type slug
 * @return		N/A
 */
function get_data_type_template($type) {

	if ( $type && file_exists( TEMPLATEPATH . '/view/data-types/' . $type . '.php' ) ) {
		include( TEMPLATEPATH . '/view/data-types/' . $type . '.php' );
	}

}

/**
 * get_current_lang
 *
 * Gets current language
 *
 * @since		1.0
 * @param		N/A
 * @return		(string)
 */
function get_current_lang() {

	// Get current language
	$permalink = bhjs_core()->get_attribute( 'permalink' );

	if ( $permalink ) {
		$lang = $permalink['lang'];
	}

	if ( ! $lang ) {
		$lang = 'en';
	}

	// return
	return $lang;

}

/**
 * languages_switcher
 *
 * Displays language switcher
 *
 * @since		1.0
 * @param		N/A
 * @return		(string)	language switcher button
 */
function languages_switcher() {

	$curr_lang	= get_current_lang();
	$languages	= bhjs_core()->get_attribute( 'languages' );
	$place_slug	= bhjs_core()->get_attribute( 'place_slug' );
	$output		= '';

	if ( ! empty($languages) ) {

		foreach ( $languages as $l ) {
			if ( $l['slug'] != $curr_lang ) {
				$output .=
					'<div class="language-switcher-btn">' .
						'<a href="' . bhjs_get_siteurl() . '/' . $place_slug . '/' . $l['slug'] . '">' .
							strtoupper( mb_substr($l['name'], 0, 3, 'UTF-8') ) .
						'</a>' .
					'</div>';
			}
		}

	}

	//return
	return $output;

}

/**
 * index_generator
 *
 * Displays letters index
 *
 * @since		1.0
 * @param		$id (string) index ID
 * @return		(string)
 */
function index_generator($id) {

	if ( ! $id )
		return '';

	global $lang;
	
	$output = '';

	if ($lang == 'he') {
		$letters = array( 'א','ב','ג','ד','ה','ו','ז','ח','ט','י','כ','ל','מ','נ','ס','ע','פ','צ','ק','ר','ש','ת' );
	}
	else {
		$letters = range( 'A', 'Z' );
	}

	$output .= '<ul class="letter-index-container" id="' . $id . '">';

		foreach ($letters as $l) {
			$output .= '<li>' . $l . '</li>';
		}

	$output .= '</ul>';

	// return
	return $output;

}
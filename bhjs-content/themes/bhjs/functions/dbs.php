<?php
/**
 * DBS functions
 *
 * @author		Nir Goldberg
 * @package		jewish-spotlight/bhjs-content/themes/bhjs/functions
 * @version		1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * sort_place_data
 *
 * Arrange place data in an array of unit types
 *
 * @since		1.0
 * @param		N/A
 * @return		(mixed)
 */
function sort_place_data() {

	$data = dbs()->get_place_data();

	if ( ! $data ) {

		// return
		return null;

	}

	$sorted_data = array();

	// sort data
	$sorted_data = $data;

	// return
	return $sorted_data;

}
<?php
/**
 * Class: dbs
 *
 * @author		Nir Goldberg
 * @package		jewish-spotlight/bhjs-content/themes/master/includes
 * @version		1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists('dbs') ) :

/**
* dbs
*/
class dbs {

	var $settings;

	/**
	 * __construct
	 *
	 * A dummy constructor to ensure dbs is only initialized once
	 *
	 * @since		1.0
	 * @param		N/A
	 * @return		N/A
	 */
	function __construct() {

		/* Do nothing here */

	}

	/**
	 * initialize
	 *
	 * The real constructor to initialize dbs
	 *
	 * @since		1.0
	 * @param		N/A
	 * @return		N/A
	 */
	function initialize() {

		$this->settings = array(
			// Basic
			'api_host'	=> 'http://api.dbs.bh.org.il/item/place_',
			'place'		=> '',

			// Unit types
			'types'		=> array(
				'community'		=> '5',
				'photo'			=> '1',
				'video'			=> '9',
				'personality'	=> '8'
			)
		);

	}

	/**
	 * get_attribute
	 *
	 * This function will return a value from the settings array found in dbs object
	 *
	 * @since		1.0
	 * @param		$name (string) the attribute name to return
	 * @return		(mixed)
	 */
	private function get_attribute( $name, $default = null ) {

		// return default if does not exist
		if( ! isset( $this->settings[$name] ) ) {

			// return
			return $default;

		}

		// return
		return $this->settings[$name];

	}

	/**
	 * set_attribute
	 *
	 * This function will update a value into the settings array found in dbs object
	 *
	 * @since		1.0
	 * @param		$name (string) the attribute name to update
	 * @param		$value (mixed) the attribute value to update
	 * @return		N/A
	 */
	private function set_attribute( $name, $value ) {

		$this->settings[$name] = $value;

	}

	/**
	 * set_place
	 *
	 * Sets place to query from
	 *
	 * @since		1.0
	 * @param		$place (string)
	 * @return		N/A
	 */
	function set_place($place) {

		$this->set_attribute('place', $place);

	}

	/**
	 * get_api_url
	 *
	 * Build the API url
	 *
	 * @since		1.0
	 * @param		N/A
	 * @return		(mixed)
	 */
	private function get_api_url() {

		$api_host	= $this->get_attribute('api_host');
		$place		= $this->get_attribute('place');

		if ( ! $api_host || ! $place ) {

			// return
			return null;

		}

		// return
		return $api_host . $place;

	}

	/**
	 * get_place_data
	 *
	 * Retrieves place data
	 *
	 * @since		1.0
	 * @param		N/A
	 * @return		(mixed)
	 */
	function get_place_data() {

		$url = $this->get_api_url();

		if ( ! $url ) {

			// return
			return null;

		}

		// get place data
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		$json_response_content = curl_exec($ch);
		curl_close($ch);
		
		$data = json_decode($json_response_content, true);

		// return
		return $data;

	}

}

/**
 * dbs
 *
 * The main function responsible for returning the one true dbs instance
 *
 * @since	1.0
 * @param	N/A
 * @return	(object)
 */
function dbs() {

	global $dbs;

	if( ! isset($dbs) ) {

		$dbs = new dbs();

		$dbs->initialize();

	}

	// return
	return $dbs;

}

// initialize
dbs();

endif; // class_exists check
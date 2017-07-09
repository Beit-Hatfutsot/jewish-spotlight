<?php
/**
 * Class: dbs
 *
 * @author		Nir Goldberg
 * @package		jewish-spotlight/bhjs-content/themes/bhjs/includes
 * @version		1.0.0
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
	 * @since		1.0.0
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
	 * @since		1.0.0
	 * @param		N/A
	 * @return		N/A
	 */
	function initialize() {

		$this->settings = array(
			// Basic
			'api_host'	=> 'http://api.dbs.bh.org.il/v1/collection/',
			'place'		=> '',

			// Unit types
			'types'					=> array(

				//timeline
				'999'				=> array(
					'slug'			=> 'timeline',
					'menu_title'	=> array(
						'en'		=> 'Timeline',
						'he'		=> 'ציר הזמן'
					),
					'section_title'	=> array(
						'en'		=> 'Timeline',
						'he'		=> 'ציר הזמן'
					)
				),

				// community
				'5'					=> array(
					'slug'			=> 'community',
					'menu_title'	=> array(
						'en'		=> 'Communities',
						'he'		=> 'קהילות'
					),
					'section_title'	=> array(
						'en'		=> 'Jewish Communities in {place_name}',
						'he'		=> 'הקהילות היהודיות ב{place_name}'
					)
				),

				// photo
				'1'					=> array(
					'slug'			=> 'photo',
					'menu_title'	=> array(
						'en'		=> 'Gallery',
						'he'		=> 'גלריה'
					),
					'section_title'	=> array(
						'en'		=> 'Photo Gallery',
						'he'		=> 'גלריית תמונות'
					)
				),

				// video
				'9'					=> array(
					'slug'			=> 'video',
					'menu_title'	=> array(
						'en'		=> 'Video',
						'he'		=> 'וידאו'
					),
					'section_title'	=> array(
						'en'		=> 'Video',
						'he'		=> 'וידאו'
					)
				),

				// luminary
				'8'					=> array(
					'slug'			=> 'luminary',
					'menu_title'	=> array(
						'en'		=> 'Luminaries',
						'he'		=> 'אישים'
					),
					'section_title'	=> array(
						'en'		=> 'Luminaries',
						'he'		=> 'אישים'
					)
				)
			)
		);

	}

	/**
	 * get_attribute
	 *
	 * This function will return a value from the settings array found in dbs object
	 *
	 * @since		1.0.0
	 * @param		$name (string) the attribute name to return
	 * @return		(mixed)
	 */
	function get_attribute( $name, $default = null ) {

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
	 * @since		1.0.0
	 * @param		$name (string) the attribute name to update
	 * @param		$value (mixed) the attribute value to update
	 * @return		N/A
	 */
	function set_attribute( $name, $value ) {

		$this->settings[$name] = $value;

	}

	/**
	 * set_place
	 *
	 * Sets place to query from
	 *
	 * @since		1.0.0
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
	 * @since		1.0.0
	 * @param		N/A
	 * @return		(mixed)
	 */
	private function get_api_url() {

		$api_host	= $this->get_attribute( 'api_host' );
		$place		= $this->get_attribute( 'place' );

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
	 * @since		1.0.0
	 * @param		N/A
	 * @return		(mixed)
	 */
	function get_place_data() {

		$url = $this->get_api_url();

		if ( ! $url ) {

			// return
			return null;

		}

		// Get place data
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		$json_response_content = curl_exec($ch);
		curl_close($ch);
		
//		$json_response_content = file_get_contents( PLACES . '/' . $this->get_attribute( 'place' ) . '/cached-api.php' );

		$data = json_decode($json_response_content, true);

		if ( ! count($data['items']) )
			return null;

		// return
		return $data;

	}

	/**
	 * get_place_sorted_data
	 *
	 * Retrieves place's types based sorted data
	 *
	 * @since		1.0.0
	 * @param		N/A
	 * @return		(mixed)
	 */
	function get_place_sorted_data() {

		// Get unsorted data
		$place_data = $this->get_place_data();

		if ( ! $place_data ) {

			// return
			return null;

		}

		// Initiate sorted data array
		$place_sorted_data = array();

		foreach ( $this->settings['types'] as $id => $type ) {
			$place_sorted_data[$id] = array();
		}

		// Insert items
		if ( $place_data['items'] ) {
			foreach ( $place_data['items'] as $item ) {
				$place_sorted_data[ $item['UnitType'] ][] = $item;
			}
		}

		// Sort items
		foreach ( $place_sorted_data as $id => $items ) {
			usort( $place_sorted_data[$id], 'cmp' );
		}

		// return
		return $place_sorted_data;

	}

}

/**
 * cmp
 *
 * Sorts array by specific array item value
 * Used to sort unit types array by Header value
 *
 * @since		1.0.0
 * @param		(array)
 * @param		(array)
 * @return		(int)
 */
function cmp($a, $b) {

	// Get current language
	$permalink = bhjs_core()->get_attribute( 'permalink' );

	if ( $permalink ) {
		$lang = $permalink['lang'];
	}

	if ( ! $lang ) {
		$lang = 'en';
	}

	// return
	return strcmp( strtolower( $a['Header'][ucfirst($lang)] ), strtolower( $b['Header'][ucfirst($lang)] ) );

}

/**
 * dbs
 *
 * The main function responsible for returning the one true dbs instance
 *
 * @since		1.0.0
 * @param		N/A
 * @return		(object)
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
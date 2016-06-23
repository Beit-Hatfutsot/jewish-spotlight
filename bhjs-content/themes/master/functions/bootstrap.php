<?php
/**
 * Bootstrap
 *
 * @author		Nir Goldberg
 * @package		jewish-spotlight/bhjs-content/themes/master/functions
 * @version		1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// General constants
if ( ! defined( 'CSS_DIR' ) )
	define( 'CSS_DIR', TEMPLATEURL . '/assets/css' );

if ( ! defined( 'JS_DIR' ) )
	define( 'JS_DIR', TEMPLATEURL . '/assets/js' );

if ( ! defined( 'IMAGES_DIR' ) )
	define( 'IMAGES_DIR', TEMPLATEURL . '/images' );

if ( ! defined( 'INCLUDES' ) )
	define( 'INCLUDES', TEMPLATEPATH . '/includes' );

/**
 * Class: bhjs_core
 *
 * @since 1.0
 */
if ( ! class_exists('bhjs_core') ) :

final class bhjs_core {

	var $settings;

	/**
	 * __construct
	 *
	 * A dummy constructor to ensure bhjs_core is only initialized once
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
	 * The real constructor to initialize bhjs_core
	 *
	 * @since		1.0
	 * @param		N/A
	 * @return		N/A
	 */
	function initialize() {

		$this->settings = array(
			'template_name'		=> array(
				'en'			=> 'Jewish Spotlight',
				'he'			=> 'זרקור יהודי'
			),
			'place_name'		=> array(				// TBD - take this data from dbs API
				'en'			=> 'Czech Republic',
				'he'			=> 'צ\'כיה'
			),
			'place_slug'		=> '',
			'template_logo'		=> IMAGES_DIR . '/logo.png',
			'credit_image'		=> IMAGES_DIR . '/credit.png',
			'credit_text'		=> array(
				'en'			=> 'מוקדש לרות פדרמן (שטקלמכר) ע"י משפחת פדרמן וחברת מלונות דן',
				'he'			=> 'מוקדש לרות פדרמן (שטקלמכר) ע"י משפחת פדרמן וחברת מלונות דן'
			),
			'languages'			=> array(
				'en'			=> array(
					'name'		=> 'English',
					'slug'		=> 'en'
				),
				'he'			=> array(
					'name'		=> 'עברית',
					'slug'		=> 'he'
				)
			),
			'permalink'			=> array(
				'url'			=> '',
				'request_uri'	=> '',
				'lang'			=> ''
			),
			'page_template'		=> ''
		);

		$this->set_permalink();
		$this->set_place();
		$this->set_page_template();
		$this->constants();
		$this->includes();

		// init
		dbs()->set_place( TEMPLATE_PLACE );

	}

	/**
	 * get_attribute
	 *
	 * This function will return a value from the settings array found in bhjs_core object
	 *
	 * @since		1.0
	 * @param		$name (string) the attribute name to return
	 * @return		(mixed)
	 */
	function get_attribute( $name, $default = null ) {

		// Return default if does not exist
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
	 * This function will update a value into the settings array found in bhjs_core object
	 *
	 * @since		1.0
	 * @param		$name (string) the attribute name to update
	 * @param		$value (mixed) the attribute value to update
	 * @return		N/A
	 */
	function set_attribute( $name, $value ) {

		$this->settings[$name] = $value;

	}

	/**
	 * set_permalink
	 *
	 * Updates permalink attribute according to request URI
	 *
	 * @since		1.0
	 * @param		N/A
	 * @return		N/A
	 */
	private function set_permalink() {

		// URL
		$this->settings['permalink']['url'] = $this->get_permalink_url();

		// Request URI
		$this->settings['permalink']['request_uri'] = $this->get_permalink_request_uri();

		// Current language
		$this->settings['permalink']['lang'] = $this->get_permalink_lang();

	}

	/**
	 * get_permalink_url
	 *
	 * Gets current permalink URL
	 *
	 * @since		1.0
	 * @param		N/A
	 * @return		(string)
	 */
	private function get_permalink_url() {

		// return
		return ( @( $_SERVER["HTTPS"] != 'on' ) ? 'http://' : 'https://' ) . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];

	}

	/**
	 * get_permalink_request_uri
	 *
	 * Gets current request URI as array of strings
	 *
	 * @since		1.0
	 * @param		N/A
	 * @return		(mixed)
	 */
	private function get_permalink_request_uri() {

		$url			= $this->settings['permalink']['url'];
		$url_components	= parse_url( $url );

		if ( ! $url_components )
			return null;

		// Remove last '/' from url path if exists
		if ( substr($url_components['path'], -1) == '/' ) {
			$url_components['path'] = rtrim( $url_components['path'], '/' );
		}

		$url_path = explode( '/', $url_components['path'] );

		// Unset first component as it's an empty one
		unset( $url_path[0] );

		// Reindex $url_path
		$url_path = array_values( $url_path );

		// return
		return $url_path;

	}

	/**
	 * get_permalink_lang
	 *
	 * Gets current language according to request URI (language indicator or 'en' as default)
	 *
	 * @since		1.0
	 * @param		N/A
	 * @return		(string) language code
	 */
	private function get_permalink_lang() {

		$requestURI	= $this->settings['permalink']['request_uri'];
		$lang		= 'en';

		if ( $requestURI[1] && array_key_exists( $requestURI[1], $this->settings['languages'] ) ) {
			$lang = $requestURI[1];
		}

		// return
		return $lang;

	}

	/**
	 * set_place
	 *
	 * Updates place_slug attribute according to request URI
	 *
	 * @since		1.0
	 * @param		N/A
	 * @return		N/A
	 */
	private function set_place() {

		$this->settings['place_slug'] = $this->get_place_slug();

	}

	/**
	 * get_place_slug
	 *
	 * Gets queried place according to request URI
	 *
	 * @since		1.0
	 * @param		N/A
	 * @return		(mixed)
	 */
	private function get_place_slug() {

		$requestURI	= $this->settings['permalink']['request_uri'];
		$place		= $requestURI[0] ? $requestURI[0] : null;

		// return
		return $place;

	}

	/**
	 * set_page_template
	 *
	 * Updates page_template attribute according to request URI
	 *
	 * @since		1.0
	 * @param		N/A
	 * @return		N/A
	 */
	private function set_page_template() {

		$path = '';

		if ( ! $this->settings['place_slug'] ) {
			$path = '404.php';
		}
		else {
			// Retrieve URL path
			$requestURI = $this->settings['permalink']['request_uri'];

			// Remove place slug
			unset( $requestURI[0] );

			// Remove language indicator if exists
			if ( $requestURI[1] && array_key_exists( $requestURI[1], $this->settings['languages'] ) ) {
				unset( $requestURI[1] );
			}

			$path = implode( '/', $requestURI );

			// Resolve path to page template
			if ( ! $path ) {
				// Main page template
				$path = 'main.php';
			}
			elseif ( file_exists( TEMPLATEPATH . '/template/' . $path . '.php' ) ) {
				$path = $path . '.php';
			}
			else {
				$path = '404.php';
			}
		}

		$this->settings['page_template'] = $path;

	}

	/**
	 * constants
	 *
	 * @since		1.0
	 * @param		N/A
	 * @return		N/A
	 */
	private function constants() {

		$lang = $this->settings['permalink']['lang'];

		if ( ! defined( 'TEMPLATE_TITLE' ) )
			define( 'TEMPLATE_TITLE', $this->settings['template_name'][$lang] . ' - ' . $this->settings['place_name'][$lang] );

		if ( ! defined( 'TEMPLATE_PLACE' ) )
			define( 'TEMPLATE_PLACE', $this->settings['place_slug'] );

	}

	/**
	 * includes
	 *
	 * @since		1.0
	 * @param		N/A
	 * @return		N/A
	 */
	private function includes() {

		include( INCLUDES . '/class-dbs.php' );

	}

}

/**
 * bhjs_core
 *
 * The main function responsible for returning the one true bhjs_core instance
 *
 * @since	1.0
 * @param	N/A
 * @return	(object)
 */
function bhjs_core() {

	global $bhjs_core;

	if( ! isset($bhjs_core) ) {

		$bhjs_core = new bhjs_core();

		$bhjs_core->initialize();

	}

	// return
	return $bhjs_core;

}

// initialize
bhjs_core();

endif; // class_exists check

// Additional constants
$permalink = bhjs_core()->get_attribute('permalink');

if ( ! defined( 'CURR_URL' ) )
	define( 'CURR_URL', $permalink['url'] );

if ( ! defined( 'CURR_REQUEST_URI' ) )
	define( 'CURR_REQUEST_URI', implode( '/', $permalink['request_uri'] ) );

if ( ! defined( 'CURR_LANG' ) )
	define( 'CURR_LANG', $permalink['lang'] );

if ( ! defined( 'PAGE_TEMPLATE' ) )
	define( 'PAGE_TEMPLATE', bhjs_core()->get_attribute('page_template') );
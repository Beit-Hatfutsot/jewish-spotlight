<?php
/**
 * Bootstrap
 *
 * @author		Nir Goldberg
 * @package		jewish-spotlight/bhjs-content/themes/bhjs/functions
 * @version		1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// General constants
if ( ! defined( 'CSS_DIR' ) )
	define( 'CSS_DIR', TEMPLATEURL . '/assets/css' );

if ( ! defined( 'JS_DIR' ) )
	define( 'JS_DIR', TEMPLATEURL . '/assets/js' );

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
			'template_name'			=> array(
				'en'				=> 'Jewish Spotlight',
				'he'				=> 'זרקור יהודי'
			),
			'place_name'			=> array(				// TBD - take this data from dbs API
				'en'				=> '',
				'he'				=> ''
			),
			'place_slug'			=> '',
			'template_logo'			=> '',
			'template_logo_small'	=> '',
			'credit_image'			=> '',
			'credit_text'			=> array(
				'en'				=> '',
				'he'				=> ''
			),
			'languages'				=> array(
				'en'				=> array(
					'name'			=> 'English',
					'slug'			=> 'en'
				),
				'he'				=> array(
					'name'			=> 'עברית',
					'slug'			=> 'he'
				)
			),
			'permalink'				=> array(
				'url'				=> '',
				'request_uri'		=> '',
				'lang'				=> ''
			),
			'page_template'			=> ''
		);

		$this->set_permalink();
		$this->set_place_slug();
		$this->set_page_template();

		$this->includes();

		$this->set_place_constants();

		// init
		dbs()->set_place( $this->settings['place_slug'] );

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

		if ( isset( $requestURI[1] ) && array_key_exists( $requestURI[1], $this->settings['languages'] ) ) {
			$lang = $requestURI[1];
		}

		// return
		return $lang;

	}

	/**
	 * set_place_slug
	 *
	 * Updates place_slug attribute according to request URI
	 *
	 * @since		1.0
	 * @param		N/A
	 * @return		N/A
	 */
	private function set_place_slug() {

		$requestURI	= $this->settings['permalink']['request_uri'];
		$place		= isset( $requestURI[0] ) ? $requestURI[0] : null;

		$this->settings['place_slug'] = $place;

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
			if ( isset( $requestURI[1] ) && array_key_exists( $requestURI[1], $this->settings['languages'] ) ) {
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
	 * set_place_constants
	 *
	 * Updates place constants attributes according to place constants configuration file
	 *
	 * @since		1.0
	 * @param		N/A
	 * @return		N/A
	 */
	private function set_place_constants() {

		$this->settings['place_name']['en']		= ( defined( 'PLACE_NAME_EN' ) ) ? PLACE_NAME_EN : '';
		$this->settings['place_name']['he']		= ( defined( 'PLACE_NAME_HE' ) ) ? PLACE_NAME_HE : '';

		$this->settings['template_logo']		= ( defined( 'PLACE_LOGO' ) ) ? PLACE_LOGO : '';
		$this->settings['template_logo_small']	= ( defined( 'PLACE_LOGO_SMALL' ) ) ? PLACE_LOGO_SMALL : '';
		$this->settings['credit_image']			= ( defined( 'PLACE_CREDIT_IMG' ) ) ? PLACE_CREDIT_IMG : '';

		$this->settings['credit_text']['en']	= ( defined( 'PLACE_CREDIT_TEXT_EN' ) ) ? PLACE_CREDIT_TEXT_EN : '';
		$this->settings['credit_text']['he']	= ( defined( 'PLACE_CREDIT_TEXT_HE' ) ) ? PLACE_CREDIT_TEXT_HE : '';

	}

	/**
	 * includes
	 *
	 * @since		1.0
	 * @param		N/A
	 * @return		N/A
	 */
	private function includes() {

		// Place constants configuration
		$place_slug			= $this->settings['place_slug'];
		$place_config_path	= PLACES . '/' . $place_slug . '/' . $place_slug . '.php';

		if ( file_exists( $place_config_path ) )
			include( $place_config_path );

		// DBS
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
$template_name	= bhjs_core()->get_attribute( 'template_name' );
$place_name		= bhjs_core()->get_attribute( 'place_name' );
$place_slug		= bhjs_core()->get_attribute( 'place_slug' );
$permalink		= bhjs_core()->get_attribute( 'permalink' );
$page_template	= bhjs_core()->get_attribute( 'page_template' );

if ( ! defined( 'TEMPLATE_TITLE' ) )
	define( 'TEMPLATE_TITLE', $template_name[ $permalink['lang'] ] . ' - ' . $place_name[ $permalink['lang'] ] );

if ( ! defined( 'TEMPLATE_PLACE' ) )
	define( 'TEMPLATE_PLACE', $place_slug );

if ( ! defined( 'CURR_URL' ) )
	define( 'CURR_URL', $permalink['url'] );

if ( ! defined( 'CURR_LANG' ) )
	define( 'CURR_LANG', $permalink['lang'] );

if ( ! defined( 'PAGE_TEMPLATE' ) )
	define( 'PAGE_TEMPLATE', $page_template );
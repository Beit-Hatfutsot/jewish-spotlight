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
			'template_title'	=> 'Jewish Spotlight - Master Template',
			'template_place'	=> 'prague',
		);

		$this->constants();
		$this->includes();

		// init
		dbs()->set_place( TEMPLATE_PLACE );

	}

	/**
	 * constants
	 *
	 * @since		1.0
	 * @param		N/A
	 * @return		N/A
	 */
	private function constants() {

		if ( ! defined( 'TEMPLATE_TITLE' ) )
			define( 'TEMPLATE_TITLE', $this->settings['template_title'] );

		if ( ! defined( 'TEMPLATE_PLACE' ) )
			define( 'TEMPLATE_PLACE', $this->settings['template_place'] );

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
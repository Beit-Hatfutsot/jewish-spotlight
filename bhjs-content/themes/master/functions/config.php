<?php
/**
 * Configuration
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

// DBS API
if ( ! defined( 'DBS' ) )
	define( 'DBS', 'api.dbs.bh.org.il' );
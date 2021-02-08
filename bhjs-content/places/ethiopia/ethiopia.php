<?php
/**
 * Ethiopeia configuration
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Place constants
if ( ! defined( 'PLACE_NAME_EN' ) )
	define( 'PLACE_NAME_EN', 'Ethiopia' );

if ( ! defined( 'PLACE_NAME_HE' ) )
	define( 'PLACE_NAME_HE', 'אתיופיה' );

if ( ! defined( 'PLACE_LOGO' ) )
	define( 'PLACE_LOGO', bhjs_get_siteurl() . '/bhjs-content/places/' . bhjs_core()->get_attribute( 'place_slug' ) . '/images/logo.png?v=2' );

if ( ! defined( 'PLACE_LOGO_SMALL' ) )
	define( 'PLACE_LOGO_SMALL', bhjs_get_siteurl() . '/bhjs-content/places/' . bhjs_core()->get_attribute( 'place_slug' ) . '/images/logo-small.png?v=2' );

if ( ! defined( 'PLACE_CREDIT_IMG' ) )
	define( 'PLACE_CREDIT_IMG', bhjs_get_siteurl() . '/bhjs-content/places/' . bhjs_core()->get_attribute( 'place_slug' ) . '/images/credit.jpg?v=2' );

if ( ! defined( 'PLACE_CREDIT_TEXT_EN' ) )
	define( 'PLACE_CREDIT_TEXT_EN', '' );

if ( ! defined( 'PLACE_CREDIT_TEXT_HE' ) )
	define( 'PLACE_CREDIT_TEXT_HE', '' );

if ( ! defined( 'MAP_CENTER_LNG' ) )
	define( 'MAP_CENTER_LNG', '' );

if ( ! defined( 'MAP_CENTER_LAT' ) )
	define( 'MAP_CENTER_LAT', '' );

if ( ! defined( 'MAP_ZOOM' ) )
	define( 'MAP_ZOOM', 7 );

if ( ! defined( 'TIMELINE_EN' ) )
	define( 'TIMELINE_EN', 'https://docs.google.com/spreadsheets/d/1viZ-Y70D2ceHN4s81WzccknuOlcU26249Wm0fbbyCbA/edit' );

if ( ! defined( 'TIMELINE_HE' ) )
	define( 'TIMELINE_HE', 'https://docs.google.com/spreadsheets/d/1Jql8X2c-NvYsos6BxyLMMTNfA3H-CeoUone1adLcsr4/edit' );

if ( ! defined( 'CSS_STYLE_SUFFIX' ) )
	define( 'CSS_STYLE_SUFFIX', 'ethiopia' );

if ( ! defined( 'GTM_ID' ) )
	define( 'GTM_ID', 'GTM-PZ4LHD6' );
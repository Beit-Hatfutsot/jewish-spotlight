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
	define( 'PLACE_CREDIT_TEXT_EN', 'In honor of Ruth Federmann nee Steckelmacher, presented by the Federmann Family and Dan Hotels Group' );

if ( ! defined( 'PLACE_CREDIT_TEXT_HE' ) )
    define( 'PLACE_CREDIT_TEXT_HE', 'מוקדש לרות פדרמן לבית שטקלמכר ע"י משפחת פדרמן וחברת מלונות דן' );

if ( ! defined( 'MAP_CENTER_LNG' ) )
    define( 'MAP_CENTER_LNG', '' );

if ( ! defined( 'MAP_CENTER_LAT' ) )
    define( 'MAP_CENTER_LAT', '' );

if ( ! defined( 'MAP_ZOOM' ) )
    define( 'MAP_ZOOM', 7 );

if ( ! defined( 'TIMELINE_EN' ) )
    define( 'TIMELINE_EN', '' );

if ( ! defined( 'TIMELINE_HE' ) )
    define( 'TIMELINE_HE', 'https://docs.google.com/spreadsheets/d/1Jql8X2c-NvYsos6BxyLMMTNfA3H-CeoUone1adLcsr4/edit' );

if ( ! defined( 'CSS_STYLE_SUFFIX' ) )
    define( 'CSS_STYLE_SUFFIX', 'ethiopia' );

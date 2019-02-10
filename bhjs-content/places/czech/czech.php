<?php
/**
 * Czech Republic configuration
 *
 * @author		Nir Goldberg
 * @package		jewish-spotlight/bhjs-content/places
 * @version		1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Place constants
if ( ! defined( 'PLACE_NAME_EN' ) )
	define( 'PLACE_NAME_EN', 'Czech Republic' );

if ( ! defined( 'PLACE_NAME_HE' ) )
	define( 'PLACE_NAME_HE', 'צ\'כיה' );

if ( ! defined( 'PLACE_LOGO' ) )
	define( 'PLACE_LOGO', bhjs_get_siteurl() . '/bhjs-content/places/' . bhjs_core()->get_attribute( 'place_slug' ) . '/images/logo.png' );

if ( ! defined( 'PLACE_LOGO_SMALL' ) )
	define( 'PLACE_LOGO_SMALL', bhjs_get_siteurl() . '/bhjs-content/places/' . bhjs_core()->get_attribute( 'place_slug' ) . '/images/logo-small.png' );

if ( ! defined( 'PLACE_CREDIT_IMG' ) )
	define( 'PLACE_CREDIT_IMG', bhjs_get_siteurl() . '/bhjs-content/places/' . bhjs_core()->get_attribute( 'place_slug' ) . '/images/credit.jpg' );

if ( ! defined( 'PLACE_CREDIT_TEXT_EN' ) )
	define( 'PLACE_CREDIT_TEXT_EN', 'In honor of Ruth Federmann nee Steckelmacher, presented by the Federmann Family and Dan Hotels Group' );

if ( ! defined( 'PLACE_CREDIT_TEXT_HE' ) )
    define( 'PLACE_CREDIT_TEXT_HE', 'מוקדש לרות פדרמן לבית שטקלמכר ע"י משפחת פדרמן וחברת מלונות דן' );

if ( ! defined( 'MAP_CENTER_LNG' ) )
    define( 'MAP_CENTER_LNG', 49.81995 );

if ( ! defined( 'MAP_CENTER_LAT' ) )
    define( 'MAP_CENTER_LAT', 15.47490 );

if ( ! defined( 'MAP_ZOOM' ) )
    define( 'MAP_ZOOM', 7 );

if ( ! defined( 'TIMELINE_EN' ) )
    define( 'TIMELINE_EN', 'https://docs.google.com/spreadsheets/d/14_ymqMWDTb5oHYp_ZRGNZ38Awv01wLVEESvcQoruMJw/edit?invite=CKfT78QI&ts=578e2a08#gid=0' );

if ( ! defined( 'TIMELINE_HE' ) )
    define( 'TIMELINE_HE', 'https://docs.google.com/spreadsheets/d/1Mo8MFzsdEsU3LYvnds1wXTLpbytDF6-LlffLD0ZsnFE/edit?invite=CJPix-AO&ts=578e29e9#gid=0' );

if ( ! defined( 'CSS_STYLE_SUFFIX' ) )
    define( 'CSS_STYLE_SUFFIX', 'default' );

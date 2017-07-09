<?php
/**
 * Front to the Jewish Spotlight BHJS theme template
 *
 * @author		Nir Goldberg
 * @package		jewish-spotlight/bhjs-content/themes/bhjs
 * @version		1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Header
 */
get_header();

/**
 * Load page template
 */
get_page_template();

/**
 * Footer
 */
get_footer();
<?php
/**
 * Page page template
 *
 * @author      Inna & Nir
 * @package     jewish-spotlight/bhjs-content/themes/bhjs/view/page
 * @version     1.0.1
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$place_slug	= bhjs_core()->get_attribute( 'place_slug' );
$page_slug	= bhjs_core()->get_attribute( 'permalink' )['page_slug'];

global $lang;

$content = PLACES . '/' . $place_slug . '/' . $page_slug . '/' . $lang . '.html';

?>

<div class="container">
	<?php if ( file_exists($content) ) {
		require( $content );
	} ?>
</div>
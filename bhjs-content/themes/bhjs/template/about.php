<?php
/**
 * About page template
 *
 * @author      Inna & Nir
 * @package     jewish-spotlight/bhjs-content/themes/bhjs/view/page
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$place_slug = bhjs_core()->get_attribute( 'place_slug' );

global $lang;

$content = PLACES . '/' . $place_slug . '/about/' . $lang . '.html';

?>

<div class="container">
    <h1><?php echo ($lang == 'en' ? 'About' : 'אודות'); ?></h1>

    <?php if ( file_exists($content) ) {
        require( $content );
    } ?>
</div>
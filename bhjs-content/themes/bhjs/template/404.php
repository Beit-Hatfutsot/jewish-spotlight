<?php
/**
 * 404 page template
 *
 * @author      Inna & Nir
 * @package     jewish-spotlight/bhjs-content/themes/bhjs/view/page
 * @version     1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $lang;

?>

<div class="container content">
    <h1>404</h1>

    <h3><?php echo ($lang == 'en' ? 'Page not found!' : 'עמוד לא נמצא!'); ?></h3>
</div>
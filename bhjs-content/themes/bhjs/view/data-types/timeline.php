<?php
/**
 * Photo data type template
 *
 * @author      Inna
 * @package     jewish-spotlight/bhjs-content/themes/bhjs/view
 * @version     1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $lang;

if ( ( defined('TIMELINE_EN') && TIMELINE_EN != '' && $lang == 'en' ) || ( defined('TIMELINE_HE') && TIMELINE_HE != '' && $lang == 'he') ) { ?>

    <a class="menu-item-section" name="timeline"></a>
    <div class="data-type-section" id="data-type-section-timeline">

        <?php if ( $lang == 'en') { ?>
            <iframe src="<?php echo TIMELINE_EN; ?>" width='100%' height='650' frameborder='0'></iframe>
        <?php } elseif ( $lang == 'he' ) { ?>
            <iframe src="<?php echo TIMELINE_HE; ?>" width='100%' height='650' frameborder='0'></iframe>
        <?php } ?>

    </div>

<?php }
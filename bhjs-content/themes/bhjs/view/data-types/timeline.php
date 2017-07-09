<?php
/**
 * Photo data type template
 *
 * @author      Inna
 * @package     jewish-spotlight/bhjs-content/themes/bhjs/view
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $lang;

if ( ( defined('TIMELINE_EN') && TIMELINE_EN != '' && $lang == 'en' ) || ( defined('TIMELINE_HE') && TIMELINE_HE != '' && $lang == 'he') ) {

    $src = ($lang == 'en') ? TIMELINE_EN : TIMELINE_HE;

    ?>

    <a class="menu-item-section" name="timeline"></a>
    <div class="data-type-section" id="data-type-section-timeline">

        <div id='timeline-embed' style="width: 100%; height: 600px"></div>

        <!-- TimeLine3 -->
        <script src="https://cdn.knightlab.com/libs/timeline3/latest/js/timeline.js"></script>

        <script type="text/javascript">
          // The TL.Timeline constructor takes at least two arguments:
          // the id of the Timeline container (no '#'), and
          // the URL to your JSON data file or Google spreadsheet.
          // the id must refer to an element "above" this code,
          // and the element must have CSS styling to give it width and height
          // optionally, a third argument with configuration options can be passed.
          // See below for more about options.
          timeline = new TL.Timeline('timeline-embed',
            '<?php echo $src; ?>');
        </script>

    </div>

<?php }
<?php
/**
 * Video data type template
 *
 * @author		Nir Goldberg
 * @package		jewish-spotlight/bhjs-content/themes/bhjs/view/data-types
 * @version		1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $lang, $data;
$settings = array(
    'type_id' => 9
);

?>

<div class="data-type-section" id="data-type-section-video">

    <?php foreach ( $data[ $settings['type_id'] ] as $video ) {
        $title        = $video['Header'][ucfirst($lang)];
        $desc         = $video['UnitText1'][ucfirst($lang)];
        $video_src    = $video['video_url'];
        $video_poster = $video['main_image_url'];
        ?>

        <div class="col-sm-6">
            <figure>
                <div class="video-wrapper">
                    <button class="video-btn-wrap">
                        <div class="arrow-right"></div>
                    </button>
                    <video src="<?php echo $video_src ?>" poster="<?php echo $video_poster; ?>" height="auto" width="100%" controls type="video/mp4"></video>
                </div>
                <figcaption>
                    <h3><?php echo $title; ?></h3>
                    <p><?php echo $desc; ?></p>
                </figcaption>
            </figure>
        </div>
    <?php } ?>
</div>
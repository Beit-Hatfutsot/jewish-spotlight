<?php
/**
 * Community data type template
 *
 * @author      Nir Goldberg
 * @package     jewish-spotlight/bhjs-content/themes/bhjs/view/data-types
 * @version     1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $lang, $data;
$settings = array(
    'type_id'       => 5,
    'dbs_prefix'    => 'http://dbs.bh.org.il/' . ($lang == 'he' ? 'he/' : ''),
    'src_prefix'    => 'https://storage.googleapis.com/bhs-flat-pics/',

);

?>
<div class="data-type-section" id="data-type-section-community">
    <div><?php echo index_generator('community'); ?></div>
    <?php foreach ( $data[ $settings['type_id'] ] as $place ) {
        $title  = $place['Header'][ucfirst($lang)];
        $desc   = $place['UnitText1'][ucfirst($lang)];
        $reversed_slug = explode("_", $place['Slug']['He']);
        $heb_slug = $reversed_slug[1] . '/' . $reversed_slug[0];
        $slug = $lang == 'he' ? $heb_slug : str_replace('_', '/', $place['Slug']['En']);
        $photo  = '';
        $pictures = $place['Pictures'];

        if ( count ( $pictures ) ) {
            foreach ( $pictures as $photo ) {
                if ( !is_null( $photo['PictureId'] ) && $photo['IsPreview'] == '1' ) {
                    $place_photo = $photo['PictureId'] . '.jpg';
                }
            }
        } ?>

		<div class="item-preview" data-letter="<?php echo ucfirst ( mb_substr($title, 0, 1, 'UTF-8') ); ?>">
          <a href="<?php echo $settings['dbs_prefix'] . $slug; ?>" target="_blank">
            <div class="thumbnail">
              <img src="<?php echo $settings['src_prefix'] . $place_photo; ?>" alt="<?php echo $title; ?>"/>
            </div>
            <div class="text-part <?php echo count($pictures)>0 ? 'text-part--thumbnail' : 'text-part--nothumb'; ?>">
                <div class="text <?php echo count($pictures) == 0 ? 'text--nothumb' : ''; ?>">
                    <?php echo $desc; ?>
                </div>
                <div class="<?php echo count($pictures) ? 'diagonal-block' : ''?>">
                    <div class="diagonal-separator" style="right:-22px; opacity:1"></div>
                    <div class=" <?php echo count($pictures)>1 ? 'diagonal-separator' : '' ?>" style="right:-10px; opacity:0.7"></div>
                    <div class=" <?php echo count($pictures)>1 ? 'diagonal-separator' : '' ?>" style="right:2px; opacity:0.4"></div>
                </div>
                <div class="header <?php  echo count($pictures) == 0 ? 'header--nothumb' : '' ?>">
                    <?php echo $title ?>
                </div>
            </div>
          </a>
        </div>
    <?php } ?>
        
</div>
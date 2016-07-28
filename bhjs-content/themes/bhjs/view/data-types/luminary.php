<?php
/**
 * Personality data type template
 *
 * @author      Nir Goldberg
 * @package     jewish-spotlight/bhjs-content/themes/bhjs/view/data-types
 * @version     1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $lang, $data;
$settings = array(
    'type_id'       => 8,
    'dbs_prefix'    => 'http://dbs.bh.org.il/' . ($lang == 'he' ? 'he/' : ''),
    'src_prefix'    => 'https://storage.googleapis.com/bhs-flat-pics/',
);

?>

<div class="data-type-section" id="data-type-section-luminary">
    
    <div><?php echo index_generator('luminary'); ?></div>

    <?php foreach ( $data[ $settings['type_id'] ] as $luminary ) {
        $title  = $luminary['Header'][ucfirst($lang)];
        $desc   = $luminary['UnitText1'][ucfirst($lang)];
        $reversed_slug = explode("_", $luminary['Slug']['He']);
        $heb_slug = $reversed_slug[1] . '/' . $reversed_slug[0];
        $slug = $lang == 'he' ? $heb_slug : str_replace('_', '/', $luminary['Slug']['En']);
        $photo  = '';
        $pictures = $luminary['Pictures'];

        if ( count ( $pictures ) ) {
            foreach ( $pictures as $photo ) {
                if ( !is_null( $photo['PictureId'] ) && $photo['IsPreview'] == '1' ) {
                    $luminary_photo = $photo['PictureId'] . '.jpg';
                }
            }
        } ?>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="item-preview" data-letter="<?php echo ucfirst ( mb_substr($title, 0, 1, 'UTF-8') ); ?>">
              <a href="<?php echo $settings['dbs_prefix'] . $slug; ?>" target="_blank">
                <div class="thumbnail">
                  <img src="<?php echo $settings['src_prefix'] . $luminary_photo; ?>" alt="<?php echo $title; ?>"/>
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
        </div>
    <?php } ?>

    <p class="notification"><?php echo ( $lang == 'en' ? 'No items found, please try another search' : 'לא נמצאו פריטים, אנא נסו חיפוש אחר' ); ?></p>
</div>
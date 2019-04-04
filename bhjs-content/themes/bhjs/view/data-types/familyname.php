<?php
/**
 * Family Name data type template
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $lang, $data;
$settings = array(
    'type_id'       => 6,
    'dbs_prefix'    => 'https://dbs.bh.org.il/' . ($lang == 'he' ? 'he/' : ''),
    'src_prefix'    => 'https://storage.googleapis.com/bhs-flat-pics/',
);

?>

<div class="data-type-section" id="data-type-section-familyname">
    
    <div><?php echo index_generator('familyname'); ?></div>

    <?php foreach ( $data[ $settings['type_id'] ] as $luminary ) {
        $title  = $luminary['Header'][ucfirst($lang)];
        $desc   = $luminary['UnitText1'][ucfirst($lang)];
        // $reversed_slug = explode("_", $luminary['Slug']['He']);
        // $heb_slug = $reversed_slug[1] . '/' . $reversed_slug[0];
        // $slug = $lang == 'he' ? $heb_slug : str_replace('_', '/', $luminary['Slug']['En']);
        // $photo  = '';
        // $pictures = $luminary['image_urls'];
        // $luminary_photo = $luminary['preview_image_url'];
        $url = $luminary['item_url_'.$lang];

        ?>
        <div class="col-md-4 col-sm-6 col-xs-12 hidden">
            <div class="item-preview" data-letter="<?php echo ucfirst ( mb_substr($title, 0, 1, 'UTF-8') ); ?>">
              <a href="<?php echo $url; ?>" target="_blank">
                <div class="thumbnail"></div>
                <div class="text-part text-part--nothumb">
                    <div class="text text--nothumb">
                        <?php echo $desc; ?>
                    </div>
                    <div class="">
                        <div class="diagonal-separator" style="right:-22px; opacity:1"></div>
                        <div class=" " style="right:-10px; opacity:0.7"></div>
                        <div class=" " style="right:2px; opacity:0.4"></div>
                    </div>
                    <div class="header header--nothumb">
                        <?php echo $title ?>
                    </div>
                </div>
              </a>
            </div>
        </div>
    <?php } ?>

    <p class="notification"><?php echo ( $lang == 'en' ? 'No items found, please try another search' : 'לא נמצאו פריטים, אנא נסו חיפוש אחר' ); ?></p>

    <?php if ( count($data[ $settings['type_id'] ]) > 6 ) { ?>
		<button class="btn load-more"><?php if ($lang == 'en') {
		    echo 'Load more';
        } else {
            echo 'טען עוד'
        }</button>
	<?php } ?>
</div>
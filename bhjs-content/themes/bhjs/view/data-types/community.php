<?php
/**
 * Community data type template
 *
 * @author      Nir Goldberg
 * @package     jewish-spotlight/bhjs-content/themes/bhjs/view/data-types
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $lang, $data;
$settings = array(
    'type_id'       => 5,
    'dbs_prefix'    => 'https://dbs.bh.org.il/' . ($lang == 'he' ? 'he/' : ''),
    'src_prefix'    => 'https://storage.googleapis.com/bhs-flat-pics/',
);

$markers = array();

?>

<div class="data-type-section" id="data-type-section-community">

    <?php if ( defined('MAP_CENTER_LNG') && MAP_CENTER_LNG != '' && defined('MAP_CENTER_LAT') && MAP_CENTER_LAT != '' && defined('MAP_ZOOM') && MAP_ZOOM != '' ) { ?>
        <script>
            var _map_center_lng = <?php echo MAP_CENTER_LNG; ?>,
                _map_center_lat = <?php echo MAP_CENTER_LAT; ?>,
                _map_zoom = <?php echo MAP_ZOOM; ?>;
        </script>
        <div id="communities_map" style="height: 440px; width: 100%; border: 1px solid #AAA;"></div>
    <?php } ?>

    <div><?php echo index_generator('community'); ?></div>

    <?php foreach ( $data[ $settings['type_id'] ] as $place ) {
        $title  = $place['Header'][ucfirst($lang)];
        $desc   = $place['UnitText1'][ucfirst($lang)];
        $reversed_slug = explode("_", $place['Slug']['He']);
        $heb_slug = $reversed_slug[1] . '/' . $reversed_slug[0];
        $slug = $lang == 'he' ? $heb_slug : str_replace('_', '/', $place['Slug']['En']);
        $photo  = '';
        $pictures = $place['image_urls'];
        $place_photo = $place['preview_image_url'];

        //to get coordinates
        $coordinates = get_community_coordinates( $place['Header']['En'] );

        if ( $coordinates['lat'] && $coordinates['lng'] ) {
            $markers[] = array(
                'name_en'   => $place['Header']['En'],
                'name_he'   => str_replace("'", "", $place['Header']['He']),
                'url'       => $settings['dbs_prefix'] . $slug,
                'lat'       => $coordinates['lat'],
                'lng'       => $coordinates['lng']
            );
        }

        ?>

		<div class="col-md-4 col-sm-6 col-xs-12 hidden">
            <div class="item-preview" data-letter="<?php echo ucfirst ( mb_substr($title, 0, 1, 'UTF-8') ); ?>">
              <a href="<?php echo $settings['dbs_prefix'] . $slug; ?>" target="_blank">
                
                <?php if ( $place_photo ) { ?>
                    <div class="thumbnail">
                      <img src="<?php echo $place_photo; ?>" alt="<?php echo $title; ?>"/>
                    </div>
                <?php } ?>

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

    <script>
        _map_markers = '<?php echo json_encode($markers); ?>';
    </script>
        
</div>
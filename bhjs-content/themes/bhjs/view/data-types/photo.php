<?php
/**
 * Photo data type template
 *
 * @author		Nir Goldberg
 * @package		jewish-spotlight/bhjs-content/themes/bhjs/view/data-types
 * @version		1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $lang, $data;

$settings = array(
	'type_id'		=> 1,
	'src_prefix'	=> 'https://storage.googleapis.com/bhs-flat-pics/'
);

?>

<div class="data-type-section" id="data-type-section-photo">

	<div id="gallery-1" class="gallery" itemscope itemtype="http://schema.org/ImageGallery">

		<?php 
			$photos = array();

			foreach ( $data[ $settings['type_id'] ] as $collection ) {
				$title	= $collection['Header'][ucfirst($lang)];
				$desc	= $collection['UnitText1'][ucfirst($lang)];
				$collection_photos	= array();

				if ( count( $collection['Pictures'] ) ) {
					foreach ( $collection['Pictures'] as $photo ) {

						if ( ! is_null( $photo['PictureId'] ) ) {
							$title = str_replace(array("\r\n", "\n", "\r"), ' ', $title);
							$title = str_replace('"', '\"', $title);

							$collection_photos[] = array(
								'title'	=> $title,
								'photo'	=> $settings['src_prefix'] . $photo['PictureId'] . '.jpg'
							);
						}
					}
				}

				$photos = array_merge( $photos, $collection_photos );
			}
		?>

	</div>

	<button class="load-more"><?php echo $lang == 'en' ? 'Load more' : 'טען עוד'; ?></button>

	<script>
		_BhjsPhotos = '<?php echo count( $photos ) ? json_encode( $photos, JSON_ERROR_UTF8 ) : ''; ?>';
	</script>

</div>
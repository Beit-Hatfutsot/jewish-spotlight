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

			if ( $photos ) {
				$i = 0;
				while ( $i <= 2 ) { ?>

					<div class="gallery-col col<?php echo $i++; ?> col-xs-4"></div>

				<?php }
			}
		?>

	</div>

	<?php if ( $photos ) { ?>

		<button class="btn load-more"><?php echo $lang == 'en' ? 'Load more' : 'טען עוד'; ?></button>

	<?php } ?>

	<script>
		_BhjsPhotos = '<?php echo count( $photos ) ? json_encode( $photos, JSON_ERROR_UTF8 ) : ''; ?>';
	</script>

</div>
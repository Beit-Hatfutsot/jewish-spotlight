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

	<div id="gallery-1" class="gallery">

		<?php foreach ( $data[ $settings['type_id'] ] as $collection ) {

			$title	= $collection['Header'][ucfirst($lang)];
			$desc	= $collection['UnitText1'][ucfirst($lang)];
			$photos	= array();

			if ( count( $collection['Pictures'] ) ) {
				foreach ( $collection['Pictures'] as $photo ) {

					if ( ! is_null( $photo['PictureId'] ) ) {
						$photos[] = $photo['PictureId'] . '.jpg';
					}
				}
			}

			if ( count( $photos ) ) {

				$index = 1;

				foreach ( $photos as $photo ) { ?>

					<figure class="gallery-item">
						<a href="<?php echo $settings['src_prefix'] . $photo; ?>">
							<img src="<?php echo $settings['src_prefix'] . $photo; ?>" width="285" height="auto" alt="<?php echo $title . ( count($photos) > 1 ? ' - ' . $index++ : '' ); ?>" />
						</a>
					</figure>

				<?php }

			}

		} ?>

	</div>

</div>
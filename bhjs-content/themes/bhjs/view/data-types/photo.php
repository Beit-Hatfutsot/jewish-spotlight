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

				foreach ( $photos as $photo ) {

					$src = $settings['src_prefix'] . $photo; ?>

					<figure class="gallery-item" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
						<a href="<?php echo $src; ?>" itemprop="contentUrl">
							<img src="<?php echo $src; ?>" itemprop="thumbnail" width="285" height="auto" alt="<?php echo $title . ( count($photos) > 1 ? ' - ' . $index++ : '' ); ?>" />
						</a>
						<figcaption itemprop="caption description"><?php echo $title; ?></figcaption>
					</figure>

				<?php }

			}

		} ?>

	</div>

</div>
<?php
/**
 * Main page template
 *
 * @author		Nir Goldberg
 * @package		jewish-spotlight/bhjs-content/themes/bhjs/view/page
 * @version		1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$place_name = bhjs_core()->get_attribute( 'place_name' );

global $lang, $data;

?>

<a name="top"></a>

<?php get_data_type_template( 'timeline' ); ?>

<?php if ( ! empty($data) ) {
	$types = dbs()->get_attribute( 'types' );

	foreach ( $data as $id => $items ) {
		if ( array_key_exists($id, $types) && ! empty($items) ) { ?>

			<a class="menu-item-section" name="<?php echo $types[$id]['slug']; ?>"></a>
			<div class="container">
				<h2 class="section-title"><?php echo str_replace( '{place_name}', $place_name[$lang], $types[$id]['section_title'][$lang] ); ?></h2>

				<?php get_data_type_template( $types[$id]['slug'] ); ?>
			</div>

		<?php }
	}
}
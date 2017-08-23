<?php
/**
 * Footer
 *
 * @author		Nir Goldberg
 * @package		jewish-spotlight/bhjs-content/themes/bhjs/view/footer
 * @version		1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$template_name			= bhjs_core()->get_attribute( 'template_name' );
$place_name				= bhjs_core()->get_attribute( 'place_name' );
$place_slug				= bhjs_core()->get_attribute( 'place_slug' );
$template_logo_small	= bhjs_core()->get_attribute( 'template_logo_small' );
$credit_image			= bhjs_core()->get_attribute( 'credit_image' );
$credit_text			= bhjs_core()->get_attribute( 'credit_text' );
$languages				= bhjs_core()->get_attribute( 'languages' );

global $lang, $data;

$about_content = PLACES . '/' . $place_slug . '/about/' . $lang . '.html';

?>

<footer>

	<div class="container">
		<?php if ( $data && $template_logo_small ) { ?>
			<div id="logo"><img src="<?php echo $template_logo_small; ?>" alt="<?php echo $template_name[$lang] . ' - ' . $place_name[$lang]; ?>" /></div>
		<?php } ?>

		<div id="credit">
			<?php if ( $data && $credit_image ) { ?>
				<div id="credit-image"><img src="<?php echo $credit_image; ?>" alt="" /></div>
			<?php } ?>

			<h1 <?php echo ( ! $data ) ? 'class="vertical-align"' : ''; ?>><?php echo $template_name[$lang] . ( $data ? ': ' . $place_name[$lang] : '' ); ?></h1>

			<?php if ( $data && $credit_text ) { ?>
				<div id="credit-text"><?php echo $credit_text[$lang]; ?></div>
			<?php } ?>
		</div>

		<div class="language-switcher-wrapper">
			<?php if ( file_exists( $about_content ) ) { ?>
				<div class="about-btn">
					<div class="bhjs-btn"><a href="<?php echo bhjs_get_siteurl() . '/' . $place_slug . '/' . $lang . '/about'; ?>"><?php echo $lang == 'en' ? 'About' : 'אודות'; ?></a></div>
				</div>
			<?php } ?>

			<?php if ( $data ) { ?>
				<div class="language-switcher"><?php echo languages_switcher(); ?></div>
			<?php } ?>
		</div>

		<div id="bh-logo"><a class="<?php echo $lang ? $lang : 'en'; ?>" href="https://www.bh.org.il/<?php echo $lang == 'he' ? 'he/' : ''; ?>" target="_blank"></a></div>
	</div>

</footer>
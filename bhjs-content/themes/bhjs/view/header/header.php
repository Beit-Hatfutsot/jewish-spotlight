<?php
/**
 * Header
 *
 * @author		Nir Goldberg
 * @package		jewish-spotlight/bhjs-content/themes/bhjs/view/header
 * @version		1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$template_name	= bhjs_core()->get_attribute( 'template_name' );
$place_name		= bhjs_core()->get_attribute( 'place_name' );
$template_logo	= bhjs_core()->get_attribute( 'template_logo' );
$credit_image	= bhjs_core()->get_attribute( 'credit_image' );
$credit_text	= bhjs_core()->get_attribute( 'credit_text' );
$languages		= bhjs_core()->get_attribute( 'languages' );

global $lang, $data;

$lang	= get_current_lang();
$data	= dbs()->get_place_sorted_data();

?>

<header>

	<div id="header-top">
		<div class="container">
			<?php if ( $template_logo ) { ?>
				<div id="logo"><a href="#top"><img src="<?php echo $template_logo; ?>" alt="<?php echo $template_name[$lang] . ' - ' . $place_name[$lang]; ?>" /></a></div>
			<?php } ?>

			<div id="credit">
				<?php if ( $credit_image ) { ?>
					<div id="credit-image"><img src="<?php echo $credit_image; ?>" alt="" /></div>
				<?php } ?>

				<h1><?php echo $template_name[$lang] . ': ' . $place_name[$lang]; ?></h1>

				<?php if ( $credit_text ) { ?>
					<div id="credit-text"><?php echo $credit_text[$lang]; ?></div>
				<?php } ?>
			</div>

			<div class="language-switcher"><?php echo languages_switcher(); ?></div>

			<div id="bh-logo"><a class="<?php echo $lang ? $lang : 'en'; ?>" href="http://www.bh.org.il/<?php echo $lang == 'he' ? 'he/' : ''; ?>" target="_blank"></a></div>
		</div>
	</div>

	<div id="header-bottom">
		<?php if ( ! empty($data) ) {
			$types = dbs()->get_attribute( 'types' ); ?>

			<nav class="navbar navbar-inverse navbar-fixed-top">
				<div class="container">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					</div>
					<div id="navbar" class="collapse navbar-collapse">
						<ul class="nav navbar-nav">

							<?php foreach ( $data as $id => $items ) {
								if ( ! empty($items) ) {
									echo '<li><a href="#' . $types[$id]['slug'] . '">' . $types[$id]['menu_title'][$lang] . '</a></li>';
								}
							} ?>

						</ul>
					</div><!--/.nav-collapse -->
				</div>
			</nav>

		<?php } ?>
	</div>

</header>
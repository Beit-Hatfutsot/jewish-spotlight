<?php
/**
 * Header
 *
 * @author		Nir Goldberg
 * @package		jewish-spotlight/bhjs-content/themes/bhjs/view/header
 * @version		1.0.1
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$template_name	= bhjs_core()->get_attribute( 'template_name' );
$place_name		= bhjs_core()->get_attribute( 'place_name' );
$place_slug		= bhjs_core()->get_attribute( 'place_slug' );
$template_logo	= bhjs_core()->get_attribute( 'template_logo' );
$credit_image	= bhjs_core()->get_attribute( 'credit_image' );
$credit_text	= bhjs_core()->get_attribute( 'credit_text' );
$languages		= bhjs_core()->get_attribute( 'languages' );
$page_template	= bhjs_core()->get_attribute( 'page_template' );

global $lang, $data;

$lang	= get_current_lang();
$data	= dbs()->get_place_sorted_data();

?>

<header>

	<div id="header-top">
		<div class="container">
			<?php if ( $data && $template_logo ) { ?>
				<div id="logo"><a class="anchor" href="<?php echo "https://spotlight.bh.org.il/".$place_slug."/".$lang ;?>"><img src="<?php echo $template_logo; ?>" alt="<?php echo $template_name[$lang] . ' - ' . $place_name[$lang]; ?>" /></a></div>
			<?php } ?>

			<div id="credit">
				<?php if ( $data && $credit_image ) { ?>
					<div id="credit-image"><img src="<?php echo $credit_image; ?>" alt="" /></div>
				<?php } ?>

				<h1 <?php echo empty($credit_text[$lang]) ? 'style="margin-top:33px;"' : '' ?> <?php echo ( ! $data ) ? 'class="vertical-align"' : ''; ?>><?php echo $template_name[$lang] . ( $data ? ': ' . $place_name[$lang] : '' ); ?></h1>

				<?php if ( $data && $credit_text ) { ?>
					<div id="credit-text"><?php echo $credit_text[$lang]; ?></div>
				<?php } ?>
			</div>

			<?php if ( $data ) { ?>
				<div class="language-switcher"><?php echo languages_switcher(); ?></div>
			<?php } ?>

			<div id="bh-logo"><a class="<?php echo $lang ? $lang : 'en'; ?>" href="https://www.bh.org.il/<?php echo $lang == 'he' ? 'he/' : ''; ?>" target="_blank"></a></div>
		</div>
	</div>

	<div id="header-bottom">
		<nav class="navbar">
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

						<?php if ( $page_template == 'main.php' ) {
							// main page template
							if (PLACE_NAME_EN == "Ethiopia") {
								$title = ($lang == "he") ? "אודות" : "About";
								$url = "https://spotlight.bh.org.il/ethiopia/".$lang."/about";
								echo '<li><a class="anchor" href="' . $url . '">' . $title . '</a></li>';
							}
							if ( ! empty($data) ) {
								$types = dbs()->get_attribute( 'types' );

								if ( ( defined('TIMELINE_EN') && TIMELINE_EN != '') || ( defined( ('TIMELINE_HE')) && TIMELINE_HE != '' ) )
									echo '<li><a class="anchor" data-href="' . $types['999']['slug'] . '">' . $types['999']['menu_title'][$lang] . '</a></li>';

								foreach ( $data as $id => $items ) {
									if ( array_key_exists($id, $types) && ! empty($items) ) {
										echo '<li><a class="anchor" data-href="' . $types[$id]['slug'] . '">' . $types[$id]['menu_title'][$lang] . '</a></li>';
									}
								}

								if (PLACE_NAME_EN == "Ethiopia") {
									$title = ($lang == "he") ? "ערכה חינוכית" : "Educational Kit";
									$url = "https://spotlight.bh.org.il/ethiopia/".$lang."/educational-kit";
									echo '<li><a class="anchor" href="' . $url . '">' . $title . '</a></li>';

									if ($lang == "he") {
										$title = "מידע נוסף";
										$url = "https://spotlight.bh.org.il/ethiopia/".$lang."/more-info";
										echo '<li><a class="anchor" href="' . $url . '">' . $title . '</a></li>';
									}
								}
							}
						}
						elseif ( $data ) {
							// internal page
							echo '<li><a href="' . bhjs_get_siteurl() . '/' . $place_slug . '/' . $lang . '">' . ( $lang == 'en' ? 'Back to Homepage' : 'חזרה לעמוד הבית' ) . '</a></li>';
						} ?>

					</ul>
				</div>
			</div>
		</nav>
	</div>

</header>

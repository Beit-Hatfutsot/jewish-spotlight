<?php
/**
 * Header meta
 *
 * @author		Nir Goldberg
 * @package		jewish-spotlight/bhjs-content/themes/bhjs/view/header
 * @version		1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<?php //<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"> ?>

	<link rel="icon" href="../../favicon.ico">

	<title><?php echo TEMPLATE_TITLE; ?></title>

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

	<!-- Leaflet CSS file -->
	<link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.css" />

	<!-- active theme -->
	<link rel="stylesheet" href="<?php echo CSS_DIR; ?>/style.css">

	<?php if ( CURR_LANG == 'he' ) { ?>
		<link rel="stylesheet" href="<?php echo CSS_DIR; ?>/rtl.css">
	<?php } ?>

	<!-- PhotoSwipe - Core CSS file -->
	<link rel="stylesheet" href="<?php echo CSS_DIR; ?>/lib/PhotoSwipe/photoswipe.css"> 

	<!-- PhotoSwipe - Skin CSS file (styling of UI - buttons, caption, etc.)
	     In the folder of skin CSS file there are also:
	     - .png and .svg icons sprite, 
	     - preloader.gif (for browsers that do not support CSS animations) -->
	<link rel="stylesheet" href="<?php echo CSS_DIR; ?>/lib/PhotoSwipe/default-skin/default-skin.css"> 

	<link rel="canonical" href="<?php echo CURR_URL; ?>" />

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
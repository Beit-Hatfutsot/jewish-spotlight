<?php
/**
 * Main page template
 *
 * @author		Nir Goldberg
 * @package		jewish-spotlight/bhjs-content/themes/master/view/page
 * @version		1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<div class="container">

	<div class="starter-template">
		<h1>Bootstrap starter template</h1>
		<p class="lead">Use this document as a way to quickly start any new project.<br> All you get is this text and a mostly barebones HTML document.</p>

		<?php

			$data = sort_place_data();
			print_r($data);

		?>
	</div>

</div><!-- /.container -->
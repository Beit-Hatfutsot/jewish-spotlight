	<?php include( TEMPLATEPATH . '/view/footer/footer.php' ); ?>

	<!-- Bootstrap core JavaScript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="<?php echo JS_DIR; ?>/lib/jquery.min.js"><\/script>')</script>

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

	<?php
		$page_template = bhjs_core()->get_attribute( 'page_template' );

		if ( $page_template == 'main.php' ) { ?>
			<!-- Leaflet JavaScript file -->
			<?php if ( MAP_CENTER_LNG != '' ) { ?>
			<script src="https://unpkg.com/leaflet@1.0.0-rc.3/dist/leaflet.js"></script>
			<script src="<?php echo JS_DIR; ?>/lib/leafmap.js"></script>
			<?php } ?>

			<!-- PhotoSwipe - Core JS file -->
			<script src="<?php echo JS_DIR; ?>/lib/PhotoSwipe/photoswipe.min.js"></script> 

			<!-- PhotoSwipe - UI JS file -->
			<script src="<?php echo JS_DIR; ?>/lib/PhotoSwipe/photoswipe-ui-default.min.js"></script>
		<?php }
	?>

	<!-- jquery.waypoints.min.js -->
	<script src="<?php echo JS_DIR; ?>/lib/jquery.waypoints.min.js"></script>

	<!-- general.min.js -->
	<script src="<?php echo JS_DIR; ?>/general.min.js?v=2"></script>

	<?php include( TEMPLATEPATH . '/view/footer/footer-photoswipe.php' ); ?>

</body>
</html>
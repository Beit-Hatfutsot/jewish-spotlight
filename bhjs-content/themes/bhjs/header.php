<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns#">

<?php
	include ( TEMPLATEPATH . '/view/header/header-meta.php' );

	$page_template = bhjs_core()->get_attribute( 'page_template' );
	$page_template = $page_template ? str_replace( '.php', '', $page_template ) : '';
?>

<body <?php echo $page_template ? 'class="' . $page_template . '"' : ''; ?>>

	<?php include( TEMPLATEPATH . '/view/header/header.php' ); ?>
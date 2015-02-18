<?php
	include TEMPLATES_PATH."include/header.php";
	
	require_once(FUNCTIONS_PATH."markup_funcs.php");
	
	echo '<div id="heading">What would you like to do?</div>';
	echo '<br />';
	
	echo '<form method="GET">';
	
	echo textLinkUrl("Add a new administrator", "./?action=add");
	echo '<br />';
	echo '<br />';
	echo textLinkUrl("View the administrators", "./?action=view");
	echo '<br />';
	echo '<br />';
	echo textLinkUrl("Change your password", "./?action=change");
	
	echo '</form>';
	
	include TEMPLATES_PATH."include/footer.php";
?>
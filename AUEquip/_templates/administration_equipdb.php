<?php
	include TEMPLATES_PATH."include/header.php";
	
	require_once(FUNCTIONS_PATH."markup_funcs.php");
	
	echo '<div id="heading">What would you like to do?</div>';
	echo '<br />';
	
	echo '<form method="GET">';
	
	echo textLinkUrl("Add a spreadsheet into the database", "./?action=add");
	echo '<br />';
	echo '<br />';
	echo textLinkUrl("Clear the equipment database", "./?action=clear");
	echo '<br />';
	echo '<br />';
	echo textLinkUrl("Export the equipment database", "./?action=export");
	
	echo '</form>';
	
	
	include TEMPLATES_PATH."include/footer.php";
?>
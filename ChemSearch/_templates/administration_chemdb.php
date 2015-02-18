<?php
	include TEMPLATES_PATH."include/header.php";
	
	require_once(FUNCTIONS_PATH."markup_funcs.php");
	
	echo '<div id="heading">What would you like to do?</div>';
	echo '<br />';
	
	echo '<form method="GET">';
	
	//echo 'To add an excel spreadsheet into the database,<br />click ';
	echo textLinkUrl("Add a spreadsheet into the database", "./?action=add");
	echo '<br />';
	echo '<br />';
	echo textLinkUrl("Clear the chemical database", "./?action=clear");
	echo '<br />';
	echo '<br />';
	echo textLinkUrl("Export the chemical database", "./?action=export");
	
	echo '</form>';
	
	
	include TEMPLATES_PATH."include/footer.php";
?>
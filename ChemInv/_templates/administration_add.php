<?php
	include TEMPLATES_PATH."include/header.php";
	
	require_once(FUNCTIONS_PATH."markup_funcs.php");
	
	echo 'Select a file containing information you wish to add to the database.';
	echo '<br />';
	echo 'Only the following format is accepted: ".xlsx"';
	echo '<br />';
	echo '<br />';
	echo 'Note: This may take a few minutes, please do not stop or refresh the page.';
	
	echo '<br />';
	echo '<br />';
	
	echo '<form method="POST" enctype="multipart/form-data">';
	
	echo inputFile("spreadsheet");
	echo '<br />';
	echo '<br />';
	echo inputButton("action","Add");
	echo inputButton("action","Cancel");
	
	echo '</form>';
	
	include TEMPLATES_PATH."include/footer.php";
?>
<?php
	include TEMPLATES_PATH."include/header.php";
	
	require_once(FUNCTIONS_PATH."markup_funcs.php");
	
	echo "Do you wish to export the whole data or just the template?";
	echo '<br />';
	echo '<br />';
	echo 'Note: It may take a few minutes to generate the file, please do not stop or refresh the page.';
	
	echo '<br />';
	echo '<br />';
	
	echo '<form method="POST">';
	
	echo inputButton("action","Data");
	echo ' ';
	echo inputButton("action","Template");
	echo ' ';
	echo inputButton("action","Cancel");
	
	echo '</form>';
	
	include TEMPLATES_PATH."include/footer.php";
?>
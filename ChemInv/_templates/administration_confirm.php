<?php
	include TEMPLATES_PATH."include/header.php";
	
	require_once(FUNCTIONS_PATH."markup_funcs.php");
	
	if ($result != ""){
		echo $result;
		echo "<br />";
	}
	
	echo "Once done this action cannot be reversed.";
	
	echo '<br />';
	echo '<br />';
	
	echo '<form method="POST">';
	
	echo inputButton("action","Confirm");
	echo inputButton("action","Cancel");
	
	echo '</form>';
	
	include TEMPLATES_PATH."include/footer.php";
?>
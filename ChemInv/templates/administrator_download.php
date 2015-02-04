<?php
	include TEMPLATES_PATH."include/header.php";
	
	require_once(FUNCTIONS_PATH."markup_funcs.php");
	
	$filename = isset( $_SESSION['db_filename'] ) ? $_SESSION['db_filename'] : "";
	if ($filename == "Chemical_Database.xlsx"){
		echo downloadLink(TMP_PATH.$filename, "Download");
	}
	else if ($filename == "Chemical_Database_Template.xlsx"){
		echo downloadLink(TMP_PATH.$filename, "Download");
	}
	else{
		echo "Sorry, something unexpected occurred. Please try again.";
	}
	
	echo '<br />';
	echo '<br />';
	
	echo '<form method="POST">';
	
	echo inputButton("action","Return");
	
	echo '</form>';
	
	include TEMPLATES_PATH."include/footer.php";
?>
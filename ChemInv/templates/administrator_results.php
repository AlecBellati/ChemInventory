<?php
	include TEMPLATES_PATH."include/header.php";
	
	require_once(FUNCTIONS_PATH."markup_funcs.php");
	
	$error = $_SESSION['error'];
	
	if ($error == UPLOAD_WRONG_FILETYPE){
		echo "Wrong file type";
	}
	else{
		echo "Successfully upload";
	}
	
	echo '<br />';
	echo '<br />';
	
	echo '<form method="POST">';
	
	echo inputButton("action","Return");
	
	echo '</form>';
	
	include TEMPLATES_PATH."include/footer.php";
?>
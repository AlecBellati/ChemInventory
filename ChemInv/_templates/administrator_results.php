<?php
	include TEMPLATES_PATH."include/header.php";
	
	require_once(FUNCTIONS_PATH."markup_funcs.php");
	
	if (!isset($error)){
		$error = NO_ERROR;
	}
	if (!isset($result)){
		$result = "";
	}
	
	if ($error == UPLOAD_WRONG_FILETYPE){
		echo "Wrong file type";
	}
	else{
		echo $result;
	}
	
	echo '<br />';
	echo '<br />';
	
	echo '<form method="POST">';
	
	echo inputButton("action","Return");
	
	echo '</form>';
	
	include TEMPLATES_PATH."include/footer.php";
?>
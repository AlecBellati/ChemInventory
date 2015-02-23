<?php
	include TEMPLATES_PATH."include/header.php";
	
	require_once FUNCTIONS_PATH."markup_funcs.php";
	
	echo '<form method="GET">';
	
	$query = "SELECT * FROM function ORDER BY function.FunctionName";
	if ($result = $_SESSION['dbi']->query($query)){
		while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
			echo textLinkUrl($row['FunctionName'], "./?action=function&functionID=".$row['ID']);
			echo "<br />";
			echo "<br />";
		}
	}
	
	echo '<br />';
	echo '<br />';
	echo '<br />';
	echo inputButton('action','Return');
	
	echo '</form>';
	
	include TEMPLATES_PATH."include/footer.php";
?>
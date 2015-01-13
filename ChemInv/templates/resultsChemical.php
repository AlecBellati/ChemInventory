<?php
	include TEMPLATES_PATH."/include/header.php";
	
	require_once FUNCTIONS_PATH."/markup_funcs.php";
	require_once FUNCTIONS_PATH."/db_funcs.php";
	require_once CLASSES_PATH."/table.php";
	
	// Create a table of chemicals
	$resultsTable = new Table();
	$row = array("Chemical:", "Room:");
	$resultsTable->addRow($row);
	
	$query = "SELECT ID,ChemicalName,Room FROM chemical";
	
	// Get the search conditions
	$chemical = $_SESSION['chemicalName'];
	$room = $_SESSION['room'];
	if ($chemical != ''){
		$query .= " WHERE ChemicalName RLIKE '".$chemical."'";
		
		if ($room != ''){
			$query .= " AND Room RLIKE '".$room."'";
		}
	}
	else if ($room != ''){
		$query .= " WHERE Room RLIKE '".$room."'";
	}
	
	// Get the results in alphanumerical order
	$query .= " ORDER BY ChemicalName ASC LIMIT ".$_SESSION['resultsStart'].",".$_SESSION['resultsSize'];
	if ($result = mysql_query($query)){
		while ($resultsRow = mysql_fetch_array($result, MYSQL_BOTH)){
			$link = '<a href="./?action=viewChemical&chemicalId='.$resultsRow["ID"].'">'.$resultsRow["ChemicalName"].'</a>';
			$tableRow = array($link,$resultsRow["Room"]);
			$resultsTable->addRow($tableRow);
		}
	}
	
	echo $resultsTable->outputTable();
	
	echo '<br />';
	
	// Go back to the search page
	echo '<form method="POST" action="./?action=searchChemical">';
	
	echo inputButton('button','Back');
	
	echo '</form>';
	/*
	$query = 'SELECT COUNT(*) FROM chemical';
	$result = mysql_query($query);
	$size = mysql_result($result,0);
	
	// Form to scroll the results table
	echo '<form method="POST" action="forms/scroll_form.php" id="scrollform" name="scrollform">';
	
	if ($_SESSION['resultsStart'] > 0){
		echo inputButton('scroll','Back');
	}
	if ($_SESSION['resultsStart'] + $_SESSION['resultsSize'] < $size){
		echo inputButton('scroll','Next');
	}
	
	echo '</form>';
	*/
	include TEMPLATES_PATH."/include/footer.php";
?>
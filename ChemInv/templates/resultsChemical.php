<?php
	include TEMPLATES_PATH."/include/header.php";
	
	require_once FUNCTIONS_PATH."/markup_funcs.php";
	require_once FUNCTIONS_PATH."/db_funcs.php";
	require_once CLASSES_PATH."/table.php";
	
	// Create a table of chemicals
	$resultsTable = new Table();
	$row = array("Chemical:", "Room:");
	$resultsTable->addRow($row);
	
	$query = "SELECT ID,ChemicalName,Room FROM chemical ";
	
	// Get the search conditions
	$chemical = $_SESSION['chemicalName'];
	$room = $_SESSION['room'];
	$condition = "";
	if ($chemical != ''){
		$condition .= " WHERE ChemicalName RLIKE '".$chemical."'";
		
		if ($room != ''){
			$condition .= " AND Room RLIKE '".$room."'";
		}
	}
	else if ($room != ''){
		$condition .= " WHERE Room RLIKE '".$room."'";
	}
	$query .= $condition;
	
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
	
	
	// Form to scroll the results table
	echo '<br />';
	
	$query = 'SELECT COUNT(*) FROM chemical '.$condition;
	$result = mysql_query($query);
	$size = mysql_result($result,0);
	
	echo '<form method="POST" action="./?action=resultsChemical">';
	
	if ($_SESSION['resultsStart'] > 0){
		echo inputButton('button','Back');
	}
	if ($_SESSION['resultsStart'] + $_SESSION['resultsSize'] < $size){
		echo inputButton('button','Next');
	}
	
	echo '</form>';
	
	// Go back to the search page
	echo '<br />';
	echo '<form method="POST" action="./?action=searchChemical">';
	echo inputButton('button','Return');
	echo '</form>';
	
	include TEMPLATES_PATH."/include/footer.php";
?>
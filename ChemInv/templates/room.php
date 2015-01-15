<?php
	include TEMPLATES_PATH."/include/header.php";
	
	require_once FUNCTIONS_PATH."/markup_funcs.php";
	require_once CLASSES_PATH."/table.php";
	
	$dbi = $_SESSION['dbi'];
	
	// Create a table of chemicals
	$resultsTable = new Table();
	$row = array("Chemical:", "Room:");
	$resultsTable->addRow($row);
	
	$query = "SELECT ID,ChemicalName,Room FROM chemical ";
	
	// Get the search conditions
	$room = $_SESSION['room'];
	$condition = "";
	$condition .= " WHERE Room='".$room."'";
	$query .= $condition;
	
	// Get the results in alphanumerical order
	$query .= " ORDER BY ChemicalName ASC LIMIT ".$_SESSION['resultsStart'].",".$_SESSION['resultsSize'];
	if ($result = $dbi->query($query)){
		while ($resultsRow = mysql_fetch_array($result, MYSQL_BOTH)){
			$id = $resultsRow["ID"];
			$chemical = $resultsRow["ChemicalName"];
			$room = $resultsRow["Room"];
			$link = '<a href="./?action=chemical&chemicalId='.$id.'">'.$chemical.'</a>';
			$tableRow = array($link,$room);
			$resultsTable->addRow($tableRow);
		}
	}
	
	echo $resultsTable->outputTable();
	
	
	// Form to scroll the results table
	echo '<br />';
	
	$query = 'SELECT COUNT(*) FROM chemical '.$condition;
	$result = mysql_query($query);
	$size = mysql_result($result,0);
	
	echo '<form method="POST" action="./?action=room">';
	
	if ($_SESSION['resultsStart'] > 0){
		echo inputButton('button','Back');
	}
	if ($_SESSION['resultsStart'] + $_SESSION['resultsSize'] < $size){
		echo inputButton('button','Next');
	}
	
	echo '</form>';
	
	// Go back to the view rooms page
	echo '<br />';
	echo '<form method="POST" action="./?action=viewRooms">';
	echo inputButton('button','Return');
	echo '</form>';
	
	include TEMPLATES_PATH."/include/footer.php";
?>
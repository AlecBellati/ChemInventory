<?php
	include TEMPLATES_PATH."/include/header.php";
	
	require_once FUNCTIONS_PATH."/markup_funcs.php";
	require_once CLASSES_PATH."/table.php";
	
	$dbi = $_SESSION['dbi'];
	$tablePage = $_SESSION['tablePage'];
	$tableSize = DEFAULT_TABLE_SIZE;
	$tableStart = ($tablePage - 1) * $tableSize;
	
	// Create a table of chemicals
	$resultsTable = new Table();
	$row = array("Chemical:", "Room:");
	$resultsTable->addRow($row);
	
	$query = "SELECT chemical.ID,chemical.ChemicalName,room.RoomName";
	$query .= " FROM chemical JOIN room ON chemical.RoomID=room.ID";
	
	// Get the results in alphanumerical order
	$query .= " ORDER BY chemical.ChemicalName ASC LIMIT ".$tableStart.",".$tableSize;
	if ($result = $dbi->query($query)){
		while ($resultsRow = mysql_fetch_array($result, MYSQL_ASSOC)){
			$link = '<a href="./?action=chemical&chemicalId='.$resultsRow['ID'].'">'.$resultsRow['ChemicalName'].'</a>';
			$tableRow = array($link,$resultsRow['RoomName']);
			$resultsTable->addRow($tableRow);
		}
	}
	
	echo $resultsTable->outputTable();
	
	
	// Form to scroll the results table
	echo '<br />';
	
	$query = 'SELECT COUNT(*) FROM chemical';
	$result = mysql_query($query);
	$size = mysql_result($result,0);
	
	echo '<form method="GET">';
	
	if ($tableStart > 0){
		echo inputButton('action','Back');
	}
	if ($tableStart + $tableSize < $size){
		echo inputButton('action','Next');
	}
	
	echo '</form>';
	
	// Go back to the search page
	echo '<br />';
	echo '<form method="GET">';
	echo inputButton('action','Return');
	echo '</form>';
	
	include TEMPLATES_PATH."/include/footer.php";
?>
<?php
	include TEMPLATES_PATH."/include/header.php";
	
	require_once FUNCTIONS_PATH."/markup_funcs.php";
	require_once CLASSES_PATH."/table.php";
	
	$dbi = $_SESSION['dbi'];
	
	// Create a table of buildings
	$buildingsTable = new Table();
	$row = array("Building name:", "Campus:");
	$buildingsTable->addRow($row);
	
	$query = "SELECT BuildingName,Campus FROM building ";
	
	// Get the results in alphanumerical order
	$query .= " ORDER BY Campus ASC, BuildingName ASC LIMIT ".$_SESSION['buildingsStart'].",".$_SESSION['buildingsSize'];
	if ($result = $dbi->query($query)){
		while ($resultsRow = mysql_fetch_array($result, MYSQL_BOTH)){
			$buildingName = $resultsRow["BuildingName"];
			$campus = $resultsRow["Campus"];
			$link = '<a href="./?action=viewRooms&BuildingName='.$buildingName.'">'.$buildingName.'</a>';
			$tableRow = array($link,$campus);
			$buildingsTable->addRow($tableRow);
		}
	}
	
	echo $buildingsTable->outputTable();
	
	// Form to scroll the buildings table
	echo '<br />';
	
	$query = 'SELECT COUNT(*) FROM building ';
	$result = mysql_query($query);
	$size = mysql_result($result,0);
	
	echo '<form method="POST" action="./?action=viewBuildings">';
	
	if ($_SESSION['buildingsStart'] > 0){
		echo inputButton('button','Back');
	}
	if ($_SESSION['buildingsStart'] + $_SESSION['buildingsSize'] < $size){
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
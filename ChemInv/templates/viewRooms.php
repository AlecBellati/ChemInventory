<?php
	include TEMPLATES_PATH."/include/header.php";
	
	require_once FUNCTIONS_PATH."/markup_funcs.php";
	require_once CLASSES_PATH."/table.php";
	
	$dbi = $_SESSION['dbi'];
	
	// Create a table of chemicals
	$roomsTable = new Table();
	$row = array("Floor:", "Room:");
	$roomsTable->addRow($row);
	
	$query = "SELECT * FROM room ";
	
	// Get the room conditions
	$building = $_GET['BuildingName'];
	$condition = "WHERE Building='".$building."'";
	$query .= $condition;
	
	// Get the results in alphanumerical order
	$query .= " ORDER BY RoomFloor ASC,RoomName ASC LIMIT ".$_SESSION['roomsStart'].",".$_SESSION['resultsSize'];
	echo $query;
	if ($result = $dbi->query($query)){
		while ($resultsRow = mysql_fetch_array($result, MYSQL_BOTH)){
			$floor = $resultsRow["RoomFloor"];
			$name = $resultsRow["RoomName"];
			$link = '<a href="./?action=room&roomName='.$name.'">'.$name.'</a>';
			$tableRow = array($floor,$link);
			$roomsTable->addRow($tableRow);
		}
	}
	
	echo $roomsTable->outputTable();
	
	// Form to scroll the rooms table
	echo '<br />';
	
	$query = 'SELECT COUNT(*) FROM room '.$condition;
	$result = mysql_query($query);
	$size = mysql_result($result,0);
	
	echo '<form method="POST" action="./?action=viewRooms">';
	
	if ($_SESSION['roomsStart'] > 0){
		echo inputButton('button','Back');
	}
	if ($_SESSION['roomsStart'] + $_SESSION['roomsSize'] < $size){
		echo inputButton('button','Next');
	}
	
	echo '</form>';
	
	// Go back to the search page
	echo '<br />';
	echo '<form method="POST" action="./?action=viewBuildings">';
	echo inputButton('button','Return');
	echo '</form>';
	
	include TEMPLATES_PATH."/include/footer.php";
?>
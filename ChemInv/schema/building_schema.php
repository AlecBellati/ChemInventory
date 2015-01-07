<?php
	function createTableBuilding($conn){
		$create = "create table Building(";
		$create = $create . "BuildingName char(40) not null,";
		$create = $create . "Campus char(40) not null,";
		$create = $create . "primary key(BuildingName)";
		$create = $create . ")";
		
		return mysql_query($create);
	}
	
	function dropTableBuilding($conn){
		$drop = "drop table Building";
		
		return mysql_query($drop);
	}
?>
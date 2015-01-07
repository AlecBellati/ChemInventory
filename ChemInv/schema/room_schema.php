<?php
	function createTableRoom($conn){
		$create = "create table Room(";
		$create = $create . "RoomName char(10) not null,";
		$create = $create . "RoomFloor char(5),";
		$create = $create . "Building char(40) not null,";
		$create = $create . "foreign key(Building) references building(BuildingName),";
		$create = $create . "primary key(RoomName)";
		$create = $create . ")";
		
		return mysql_query($create);
	}
	
	function dropTableRoom($conn){
		$drop = "drop table Room";
		
		return mysql_query($drop);
	}
?>
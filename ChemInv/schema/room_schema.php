<?php
	function createTableRoom($conn){
		$create = "create table Room(";
		$create .= "ID int NOT NULL AUTO_INCREMENT,";
		$create .= "RoomName char(10) NOT NULL,";
		$create .= "RoomFloor char(5),";
		$create .= "BuildingID int NOT NULL,";
		$create .= "foreign key(BuildingID) references building(ID),";
		$create .= "primary key(ID)";
		$create .= ")";
		
		return mysql_query($create);
	}
	
	function dropTableRoom($conn){
		$drop = "drop table Room";
		
		return mysql_query($drop);
	}
?>
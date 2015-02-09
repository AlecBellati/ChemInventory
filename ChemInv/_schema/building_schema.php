<?php
	function createTableBuilding($conn){
		$create = "create table Building(";
		$create .= "ID int NOT NULL AUTO_INCREMENT,";
		$create .= "BuildingName char(40) NOT NULL,";
		$create .= "CampusID int NOT NULL,";
		$create .= "foreign key(CampusID) references campus(ID),";
		$create .= "primary key(ID)";
		$create .= ")";
		
		return mysql_query($create);
	}
	
	function dropTableBuilding($conn){
		$drop = "drop table Building";
		
		return mysql_query($drop);
	}
?>
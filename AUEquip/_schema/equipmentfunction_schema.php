<?php
	function createTableEquipmentFunction($conn){
		$create = "create table EquipmentFunction(";
		$create .= "ID int NOT NULL AUTO_INCREMENT,";
		$create .= "EquipmentID int NOT NULL,";
		$create .= "FunctionID int NOT NULL,";
		$create .= "foreign key(EquipmentID) references equipment(ID),";
		$create .= "foreign key(FunctionID) references function(ID),";
		$create .= "primary key(ID)";
		$create .= ")";
		
		return mysql_query($create);
	}
	
	function dropTableEquipmentFunction($conn){
		$drop = "drop table EquipmentFunction";
		
		return mysql_query($drop);
	}
?>
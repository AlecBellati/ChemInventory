<?php
	function createTableCampus($conn){
		$create = "create table Campus(";
		$create .= "ID int NOT NULL AUTO_INCREMENT,";
		$create .= "CampusName char(40) NOT NULL,";
		$create .= "primary key(ID)";
		$create .= ")";
		
		return mysql_query($create);
	}
	
	function dropTableCampus($conn){
		$drop = "drop table Campus";
		
		return mysql_query($drop);
	}
?>
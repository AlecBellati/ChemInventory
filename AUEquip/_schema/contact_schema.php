<?php
	function createTableContact($conn){
		$create = "create table Contact(";
		$create .= "ID int NOT NULL AUTO_INCREMENT,";
		$create .= "ContactName varchar(40),";
		$create .= "Number varchar(20),";
		$create .= "Email varchar(40),";
		$create .= "primary key(ID)";
		$create .= ")";
		
		return mysql_query($create);
	}
	
	function dropTableContact($conn){
		$drop = "drop table Contact";
		
		return mysql_query($drop);
	}
?>
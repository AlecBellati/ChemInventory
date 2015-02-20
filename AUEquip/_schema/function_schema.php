<?php
	function createTableFunction($conn){
		$create = "create table Function(";
		$create .= "ID int NOT NULL AUTO_INCREMENT,";
		$create .= "FunctionName varchar(8000) NOT NULL,";
		$create .= "primary key(ID)";
		$create .= ")";
		
		return mysql_query($create);
	}
	
	function dropTableFunction($conn){
		$drop = "drop table Function";
		
		return mysql_query($drop);
	}
?>
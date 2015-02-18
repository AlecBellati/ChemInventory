<?php
	function createTableAdministrator($conn){
		$create = "create table Administrator(";
		$create .= "UserName char(20) NOT NULL,";
		$create .= "Password char(20) NOT NULL,";
		$create .= "FirstName char(20) NOT NULL,";
		$create .= "LastName char(20) NOT NULL,";
		$create .= "primary key(UserName)";
		$create .= ")";
		
		return mysql_query($create);
	}
	
	function dropTableAdministrator($conn){
		$drop = "drop table Administrator";
		
		return mysql_query($drop);
	}
?>
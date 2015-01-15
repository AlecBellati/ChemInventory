<?php
	function createTableSupplier($conn){
		$create = "create table Supplier(";
		$create .= "ID int NOT NULL AUTO_INCREMENT,";
		$create .= "SupplierName char(20),";
		$create .= "primary key(ID)";
		$create .= ")";
		
		return mysql_query($create);
	}
	
	function dropTableSupplier($conn){
		$drop = "drop table Supplier";
		
		return mysql_query($drop);
	}
?>
<?php
	function createTableSupplier($conn){
		$create = "create table Supplier(";
		$create = $create . "SupplierName char(20),";
		$create = $create . "primary key(SupplierName)";
		$create = $create . ")";
		
		return mysql_query($create);
	}
	
	function dropTableSupplier($conn){
		$drop = "drop table Supplier";
		
		return mysql_query($drop);
	}
?>
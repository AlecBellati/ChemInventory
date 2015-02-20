<?php
	function createTableEquipment($conn){
		$create = "create table Equipment(";
		$create .= "ID int NOT NULL AUTO_INCREMENT,";
		$create .= "EquipmentName varchar(40) NOT NULL,";
		$create .= "WhatItDoes varchar(max),";
		$create .= "WhatSample varchar(max),";
		$create .= "WhatInformation varchar(max),";
		$create .= "UsageFee varchar(40),";
		$create .= "RoomID int NOT NULL,";
		$create .= "ContactID int NOT NULL,";
		$create .= "foreign key(RoomID) references room(ID),";
		$create .= "foreign key(ContactID) references contact(ID),";
		$create .= "primary key(ID)";
		$create .= ")";
		
		return mysql_query($create);
	}
	
	function dropTableEquipment($conn){
		$drop = "drop table Equipment";
		
		return mysql_query($drop);
	}
?>
<?php
	function createTableChemical($conn){
		$create = "create table Chemical(";
		$create .= "ID int NOT NULL AUTO_INCREMENT,";
		$create .= "ChemicalName char(40) NOT NULL,";
		$create .= "SupplierID	int,";
		$create .= "PrimaryDGC char(5),";
		$create .= "PackingGroup char(7) check(PackingGroup = 'I' OR PackingGroup = 'II' OR PackingGroup = 'III' OR PackingGroup = 'unknown'),";
		$create .= "Hazardous char(7) check(Hazardous = 'H' OR Hazardous = 'NH' OR Hazardous = 'unknown'),";
		$create .= "PoisonsSchedule char(10),";
		$create .= "Amount char(10),";
		$create .= "Unit char(5),";
		$create .= "RoomID	int,";
		$create .= "Carcinogen varchar(1) check(Carcinogen = 0 OR Carcinogen = 1),";
		$create .= "ChemicalWeapon varchar(1) check(ChemicalWeapon = 0 OR ChemicalWeapon = 1),";
		$create .= "CSC varchar(1) check(CSC = 0 OR CSC = 1),";
		$create .= "Ototoxic varchar(1) check(Ototoxic = 0 OR Ototoxic = 1),";
		$create .= "RestrictedHazardous varchar(1) check(RestrictedHazardous = 0 OR RestrictedHazardous = 1),";
		$create .= "foreign key(SupplierID) references supplier(ID),";
		$create .= "foreign key(RoomID) references room(ID),";
		$create .= "primary key(ID)";
		$create .= ")";
		
		return mysql_query($create);
	}
	
	function dropTableChemical($conn){
		$drop = "drop table Chemical";
		
		return mysql_query($drop);
	}
?>
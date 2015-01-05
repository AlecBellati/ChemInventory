<?php
	function createTables($conn){
		createTableBuilding($conn);
		createTableRoom($conn);
		createTableSupplier($conn);
		createTableChemical($conn);
	}
	
	function dropTables($conn){
		dropTableChemical($conn);
		dropTableSupplier($conn);
		dropTableRoom($conn);
		dropTableBuilding($conn);
	}
	
	function createTableBuilding($conn){
		$create = "create table Building(";
		$create = $create . "BuildingName char(40) not null,";
		$create = $create . "Campus char(40) not null,";
		$create = $create . "primary key(BuildingName)";
		$create = $create . ")";
		
		return mysql_query($create);
	}
	
	function dropTableBuilding($conn){
		$drop = "drop table Building";
		
		return mysql_query($drop);
	}
	
	function createTableRoom($conn){
		$create = "create table Room(";
		$create = $create . "RoomName char(10) not null,";
		$create = $create . "RoomFloor char(5),";
		$create = $create . "Building char(40) not null,";
		$create = $create . "foreign key(Building) references building(BuildingName),";
		$create = $create . "primary key(RoomName)";
		$create = $create . ")";
		
		return mysql_query($create);
	}
	
	function dropTableRoom($conn){
		$drop = "drop table Room";
		
		return mysql_query($drop);
	}
	
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
	
	function createTableChemical($conn){
		$create = "create table Chemical(";
		$create = $create . "ID int not null,";
		$create = $create . "ChemicalName char(40) not null,";
		$create = $create . "Supplier	char(20),";
		$create = $create . "PrimaryDGC char(5),";
		$create = $create . "PackingGroup char(5),";
		$create = $create . "Hazardous char(5),";
		$create = $create . "PoisonousSchedule char(5),";
		$create = $create . "TotalAmount int,";
		$create = $create . "Unit char(5),";
		$create = $create . "Room	char(10) not null,";
		$create = $create . "Carcinogen int check(Carcinogen = 0 OR Carcinogen = 1),";
		$create = $create . "ChemicalWeapon int check(ChemicalWeapon = 0 OR ChemicalWeapon = 1),";
		$create = $create . "CSC int check(CSC = 0 OR CSC = 1),";
		$create = $create . "Ototoxic int check(Ototoxic = 0 OR Ototoxic = 1),";
		$create = $create . "RestrictedHazardous int check(RestrictedHazardous = 0 OR RestrictedHazardous = 1),";
		$create = $create . "foreign key(Supplier) references supplier(SupplierName),";
		$create = $create . "foreign key(Room) references room(RoomName),";
		$create = $create . "primary key(ID)";
		$create = $create . ")";
		
		return mysql_query($create);
	}
	
	function dropTableChemical($conn){
		$drop = "drop table Chemical";
		
		return mysql_query($drop);
	}
	
?>
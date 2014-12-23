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
		
		return $conn.query($create);
	}
	
	function dropTableBuilding($conn){
		$drop = "drop table Building";
		
		return $conn.query(drop);
	}
	
	function createTableRoom($conn){
		$create = "create table Room(";
		$create = $create . "RoomName char(10) not null,";
		$create = $create . "RoomFloor char(5),";
		$create = $create . "foreign key(Building) references building(BuildingName),";
		$create = $create . "primary key(RoomName)";
		$create = $create . ")";
		
		return $conn.query($create);
	}
	
	function dropTableRoom($conn){
		$drop = "drop table Room";
		
		return $conn.query(drop);
	}
	
	function createTableSupplier($conn){
		$create = "create table Supplier(";
		$create = $create . "SupplierName char(20),";
		$create = $create . "primary key(SupplierName)";
		$create = $create . ")";
		
		return $conn.query($create);
	}
	
	function dropTableSupplier($conn){
		$drop = "drop table Supplier";
		
		return $conn.query(drop);
	}
	
	function createTableChemical($conn){
		$create = "create table Chemical(";
		$create = $create . "ChemicalName char(20) not null,";
		$create = $create . "PrimaryDGC char(5),";
		$create = $create . "PackingGroup char(5),";
		$create = $create . "Hazardous char(5),";
		$create = $create . "PoisonousSchedule char(5),";
		$create = $create . "TotalAmount number(10),";
		$create = $create . "Unit char(5),";
		$create = $create . "Carcinogen number(1) check(Carcinogen = '0' OR Carcinogen = '1'),";
		$create = $create . "ChemicalWeapon number(1) check(ChemicalWeapon = '0' OR ChemicalWeapon = '1')";
		$create = $create . "CSC number(1) check(CSC = '0' OR CSC = '1'),";
		$create = $create . "Ototoxic number(1) check(Ototoxic = '0' OR Ototoxic = '1'),";
		$create = $create . "RestrictedHazardous number(1) check(RestrictedHazardous = '0' OR RestrictedHazardous = '1'),";
		$create = $create . "foreign key(Supplier) references supplier(SupplierName),";
		$create = $create . "foreign key(Room) references room(RoomName),";
		$create = $create . "primary key(ChemicalName)";
		$create = $create . ")";
		
		return $conn.query($create);
	}
	
	function dropTableChemical($conn){
		$drop = "drop table Chemical";
		
		return $conn.query(drop);
	}
	
?>
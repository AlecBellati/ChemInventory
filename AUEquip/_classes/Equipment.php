<?php
	class Equipment{
		// Equipment properties
		private $ID;
		private $equipmentName;
		private $whatItDoes;
		private $whatSample;
		private $whatInformation;
		private $usageFee;
		private $roomName;
		private $roomLevel;
		private $buildingName;
		private $campusName;
		private $contactName;
		private $contactEmail;
		private $contactNumber;
		private $functionName;
		
		// Database interface
		private $dbi;
		
		
		// Constructor
		function __construct($_dbi){
			$this->dbi = $_dbi;
		}
		
		// Get the equipment by id
		public function setByID($_id){
			$query = "SELECT equipment.*";
			$query .= ",room.RoomName,room.Level";
			$query .= ",building.BuildingName,campus.CampusName";
			$query .= ",function.FunctionName";
			$query .= ",contact.ContactName,contact.Email,contact.Number";
			$query .= " FROM equipment JOIN room ON equipment.RoomID=room.ID ";
			$query .= "JOIN building ON room.BuildingID=building.ID ";
			$query .= "JOIN campus ON building.CampusID=campus.ID ";
			$query .= "JOIN equipmentfunction ON equipmentfunction.EquipmentID=equipment.ID ";
			$query .= "JOIN function ON equipmentfunction.FunctionID=function.ID ";
			$query .= "JOIN contact ON equipment.ContactID=contact.ID ";
			$query .= "WHERE equipment.ID=".$_id;
			$result = mysql_query($query);

			$this->setProperties($result);
		}
		
		// Set the properties of the chemical
		private function setProperties($_data){
			$row = mysql_fetch_array($_data, MYSQL_BOTH);
			
			if (isset($row['ID'])) $this->ID = (int) $row['ID'];
			if (isset($row['EquipmentName'])) $this->equipmentName = $row['EquipmentName'];
			if (isset($row['WhatItDoes'])) $this->whatItDoes = $row['WhatItDoes'];
			if (isset($row['WhatSample'])) $this->whatSample = $row['WhatSample'];
			if (isset($row['WhatInformation'])) $this->whatInformation = $row['WhatInformation'];
			if (isset($row['UsageFee'])) $this->usageFee = $row['UsageFee'];
			if (isset($row['RoomName'])) $this->roomName = $row['RoomName'];
			if (isset($row['Level'])) $this->roomLevel = $row['Level'];
			if (isset($row['BuildingName'])) $this->buildingName = $row['BuildingName'];
			if (isset($row['CampusName'])) $this->campusName = $row['CampusName'];
			if (isset($row['ContactName'])) $this->contactName = $row['ContactName'];
			if (isset($row['Email'])) $this->contactEmail = $row['Email'];
			if (isset($row['Number'])) $this->contactNumber = $row['Number'];
			if (isset($row['FunctionName'])) $this->functionName = $row['FunctionName'];
			
			// Check if there is more functions to add
			while ($row = mysql_fetch_array($_data, MYSQL_BOTH)){
				if (isset($row['FunctionName'])) $this->functionName .= "<br />".$row['FunctionName'];
			}
		}
		
		// Get the id
		public function getID(){
			return $this->ID;
		}
		
		// Get the equipment name
		public function getEquipmentName(){
			return $this->equipmentName;
		}
		
		// Get what it does
		public function getWhatItDoes(){
			return $this->whatItDoes;
		}
		
		// Get the what sample it uses
		public function getWhatSample(){
			return $this->whatSample;
		}
		
		// Get what information is given
		public function getWhatInformation(){
			return $this->whatInformation;
		}
		
		// Get the usage fee
		public function getUsageFee(){
			return $this->usageFee;
		}
		
		// Get the room name
		public function getRoomName(){
			return $this->roomName;
		}
		
		// Get the room level
		public function getRoomLevel(){
			return $this->roomLevel;
		}
		
		// Get the building name
		public function getBuildingName(){
			return $this->buildingName;
		}
		
		// Get the campus name
		public function getCampusName(){
			return $this->campusName;
		}
		
		// Get the contact name
		public function getContactName(){
			return $this->contactName;
		}
		
		// Get the contact email
		public function getContactEmail(){
			return $this->contactEmail;
		}
		
		// Get the contact number
		public function getContactNumber(){
			return $this->contactNumber;
		}
		
		// Get the function name
		public function getFunctionName(){
			return $this->functionName;
		}
		
	}
?>

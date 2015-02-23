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
			$row = mysql_fetch_array($result, MYSQL_BOTH);

			$this->setProperties($row);
		}
		
		// Set the properties of the chemical
		private function setProperties($_data){
			if (isset($_data['ID'])) $this->ID = (int) $_data['ID'];
			if (isset($_data['EquipmentName'])) $this->equipmentName = $_data['EquipmentName'];
			if (isset($_data['WhatItDoes'])) $this->whatItDoes = $_data['WhatItDoes'];
			if (isset($_data['WhatSample'])) $this->whatSample = $_data['WhatSample'];
			if (isset($_data['WhatInformation'])) $this->whatInformation = $_data['WhatInformation'];
			if (isset($_data['UsageFee'])) $this->usageFee = $_data['UsageFee'];
			if (isset($_data['RoomName'])) $this->roomName = $_data['RoomName'];
			if (isset($_data['Level'])) $this->roomLevel = $_data['Level'];
			if (isset($_data['BuildingName'])) $this->buildingName = $_data['BuildingName'];
			if (isset($_data['CampusName'])) $this->campusName = $_data['CampusName'];
			if (isset($_data['ContactName'])) $this->contactName = $_data['ContactName'];
			if (isset($_data['Email'])) $this->contactEmail = $_data['Email'];
			if (isset($_data['Number'])) $this->contactNumber = $_data['Number'];
			if (isset($_data['FunctionName'])) $this->functionName = $_data['FunctionName'];
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

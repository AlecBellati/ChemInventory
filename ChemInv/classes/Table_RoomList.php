<?php
	require_once CLASSES_PATH."Table_ListTemplate.php";
	
	class Table_RoomList extends Table_ListTemplate{
		private $buildingId;
		private $level;
		private $roomName;
		
		// Constructor
		function __construct($_dbi, $_tableSize){
			$this->setup($_dbi, $_tableSize);
			$this->setBuildingSearch(null);
			$this->setLevelSearch("");
			$this->setRoomSearch("");
		}
		
		// Add the table header
		protected function addHeader(){
			$row = array("Building:", "Level:", "Room:");
			$this->addRow($row);
		}
		
		// Set the building ID search condition
		public function setBuildingSearch($_buildingId){
			$this->buildingId = $_buildingId;
		}
		
		// Set the level name search condition
		public function setLevelSearch($_levelName){
			$this->levelName = $_levelName;
		}
		
		// Set the room name search condition
		public function setRoomSearch($_roomName){
			$this->roomName = $_roomName;
		}
		
		// Get the query select
		protected function getQuerySelect(){
			return "SELECT room.ID,room.RoomName,room.Level,building.BuildingName";
		}
		
		// Get the query condition
		protected function getQueryFrom(){
			$condition = " FROM room JOIN building ON room.BuildingID=building.ID";
			
			// Get the search conditions
			$where = "";
			if ($this->buildingId != null){
				$where .= " building.ID=".$this->buildingId;
			}
			if ($this->level != ""){
				if ($where != ""){
					$where .= " AND";
				}
				
				$where .= " room.Level RLIKE '".$this->level."'";
			}
			if ($this->roomName != ""){
				if ($where != ""){
					$where .= " AND";
				}
				
				$where .= " room.RoomName RLIKE '".$this->roomName."'";
			}
			if ($where != ""){
				$condition .= " WHERE";
				$condition .= $where;
			}
			
			return $condition;
		}
		
		// Get the query order condition
		protected function getQueryOrder(){
			$tableStart = ($this->tablePage - 1) * $this->tableSize;
			return " ORDER BY building.BuildingName ASC,room.Level,room.RoomName LIMIT ".$tableStart.",".$this->tableSize;
		}
		
		// Parse the current row found from the query
		protected function parseRow($_row){
			$link = '<a href="./?action=room&roomId='.$_row['ID'].'">'.$_row['RoomName'].'</a>';
			$row = array($_row['BuildingName'], $_row['Level'], $link);
			$this->addRow($row);
		}
	}
?>

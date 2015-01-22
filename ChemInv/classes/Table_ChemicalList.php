<?php
	require_once CLASSES_PATH."/Table_ListTemplate.php";
	
	class Table_ChemicalList extends Table_ListTemplate{
		private $chemicalName;
		private $roomName;
		
		// Constructor
		function __construct($_dbi, $_tableSize){
			$this->setup($_dbi, $_tableSize);
			$this->setChemicalSearch("");
			$this->setRoomSearch("");
		}
		
		// Add the table header
		// Implemented by child
		protected function addHeader(){
			$row = array("Chemical:", "Room:");
			$this->addRow($row);
		}
		
		// Set the chemical name search condition
		public function setChemicalSearch($_chemicalName){
			$this->chemicalName = $_chemicalName;
		}
		
		// Set the room name search condition
		public function setRoomSearch($_roomName){
			$this->roomName = $_roomName;
		}
		
		// Get the query select
		protected function getQuerySelect(){
			return "SELECT chemical.ID,chemical.ChemicalName,room.RoomName";
		}
		
		// Get the query condition
		protected function getQueryFrom(){
			$condition = " FROM chemical JOIN room ON chemical.RoomID=room.ID";
			
			// Get the search conditions
			if ($this->chemicalName != ""){
				$condition .= " WHERE chemical.ChemicalName RLIKE '".$this->chemicalName."'";
				
				if ($this->roomName != ""){
					$condition .= " AND room.RoomName RLIKE '".$this->roomName."'";
				}
			}
			else if ($this->roomName != ""){
				$condition .= " WHERE room.RoomName RLIKE '".$this->roomName."'";
			}
			
			return $condition;
		}
		
		// Get the query order condition
		protected function getQueryOrder(){
			$tableStart = ($this->tablePage - 1) * $this->tableSize;
			return " ORDER BY chemical.ChemicalName ASC LIMIT ".$tableStart.",".$this->tableSize;
		}
		
		// Parse the current row found from the query
		protected function parseRow($_row){
			$link = '<a href="./?action=chemical&chemicalId='.$_row['ID'].'">'.$_row['ChemicalName'].'</a>';
			$row = array($link,$_row['RoomName']);
			$this->addRow($row);
		}
	}
?>

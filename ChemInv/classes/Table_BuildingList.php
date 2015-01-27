<?php
	require_once CLASSES_PATH."Table_ListTemplate.php";
	
	class Table_BuildingList extends Table_ListTemplate{
		private $buildingName;
		private $campusName;
		
		// Constructor
		function __construct($_dbi, $_tableSize){
			$this->setup($_dbi, $_tableSize);
			$this->setBuildingSearch("");
			$this->setCampusSearch("");
		}
		
		// Add the table header
		protected function addHeader(){
			$row = array("Building:", "Campus:");
			$this->addRow($row);
		}
		
		// Set the building name search condition
		public function setBuildingSearch($_buildingName){
			$this->buildingName = $_buildingName;
		}
		
		// Set the campus name search condition
		public function setCampusSearch($_campusName){
			$this->campusName = $_campusName;
		}
		
		// Get the query select
		protected function getQuerySelect(){
			return "SELECT building.ID,building.BuildingName,building.Campus";
		}
		
		// Get the query condition
		protected function getQueryFrom(){
			$condition = " FROM building";
			
			// Get the search conditions
			$where = "";
			if ($this->buildingName != ""){
				$where .= " building.BuildingName RLIKE '".$this->buildingName."'";
			}
			if ($this->campusName != ""){
				if ($where != ""){
					$where .= " AND";
				}
				
				$where .= " building.Campus RLIKE '".$this->campusName."'";
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
			return " ORDER BY building.BuildingName ASC LIMIT ".$tableStart.",".$this->tableSize;
		}
		
		// Parse the current row found from the query
		protected function parseRow($_row){
			$link = '<a href="./?action=building&buildingId='.$_row['ID'].'">'.$_row['BuildingName'].'</a>';
			$row = array($link,$_row['Campus']);
			$this->addRow($row);
		}
	}
?>

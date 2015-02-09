<?php
	require_once CLASSES_PATH."Table_ListTemplate.php";
	
	class Table_CampusList extends Table_ListTemplate{
		private $campusName;
		
		// Constructor
		function __construct($_dbi, $_tableSize){
			$this->setup($_dbi, $_tableSize);
			$this->setCampusSearch("");
		}
		
		// Add the table header
		protected function addHeader(){
			$row = array("Campus:");
			$this->addRow($row);
		}
		
		// Set the campus ID search condition
		public function setCampusSearch($_campusName){
			$this->campusName = $_campusName;
		}
		
		// Get the query select
		protected function getQuerySelect(){
			return "SELECT campus.CampusName,campus.ID";
		}
		
		// Get the query condition
		protected function getQueryFrom(){
			$condition = " FROM campus";
			
			// Get the search conditions
			$where = "";
			if ($this->campusName != ""){
				$where .= " campus.CampusName RLIKE '".$this->campusName."'";
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
			return " ORDER BY campus.CampusName ASC LIMIT ".$tableStart.",".$this->tableSize;
		}
		
		// Parse the current row found from the query
		protected function parseRow($_row){
			$link = '<a href="./?action=campus&campusId='.$_row['ID'].'">'.$_row['CampusName'].'</a>';
			$row = array($link);
			$this->addRow($row);
		}
	}
?>

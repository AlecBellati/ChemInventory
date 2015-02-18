<?php
	require_once CLASSES_PATH."Table_ListTemplate.php";
	
	class Table_AdministratorList extends Table_ListTemplate{
		// Constructor
		function __construct($_dbi, $_tableSize){
			$this->setup($_dbi, $_tableSize);
		}
		
		// Add the table header
		protected function addHeader(){
			$row = array("Username:", "First Name:", "Last Name:", "Action:");
			$this->addRow($row);
		}
		
		// Get the query select
		protected function getQuerySelect(){
			return "SELECT administrator.UserName,administrator.FirstName,administrator.LastName";
		}
		
		// Get the query condition
		protected function getQueryFrom(){
			$condition = " FROM administrator";
			
			return $condition;
		}
		
		// Get the query order condition
		protected function getQueryOrder(){
			$tableStart = ($this->tablePage - 1) * $this->tableSize;
			return " ORDER BY administrator.UserName ASC LIMIT ".$tableStart.",".$this->tableSize;
		}
		
		// Parse the current row found from the query
		protected function parseRow($_row){
			$link = '<a href="./?action=delete&username='.$_row['UserName'].'">Delete</a>';
			$row = array($_row['UserName'], $_row['FirstName'], $_row['LastName'], $link);
			$this->addRow($row);
		}
	}
?>

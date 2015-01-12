<?php
	require("config.php");
	
	$action = isset( $_GET['action'] ) ? $_GET['action'] : "";
	
	switch($action){
		case "search":
			search();
		case "viewChemical":
			viewChemical();
		case "":
			homepage();
	}
	
	function homepage(){
		$results = array();
		$results['pageTitle'] = "Home | ChemSearch";
		require(TEMPLATE_PATH."/homepage.php");
	}
	
	function search(){
		$results = array();
		$results['pageTitle'] = "Search | ChemSearch";
		require(TEMPLATE_PATH."/search.php");
	}
	
	function viewChemical(){
		if ( !isset($_GET["chemicalId"]) || !$_GET["chemicalId"] ) {
			homepage();
			return;
		}
		
		$chemical = new Chemical();
		$chemical->setByID($_GET["chemicalId"]);
		$results = array();
		$results['chemical'] = $chemical;
		$results['pageTitle'] = $results['chemical']->getChemicalName()." | ChemSearch";
		require(TEMPLATE_PATH."/viewChemical.php");
	}
	
?>
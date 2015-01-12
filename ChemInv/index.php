<?php
	require("config.php");
	
	$action = isset( $_GET['action'] ) ? $_GET['action'] : "";
	
	switch($action){
		case "":
			homepage();
			return;
		case "search":
			search();
			return;
		case "resultsChemical":
			resultsChemical();
			return;
		case "viewChemical":
			viewChemical();
			return;
	}
	
	function homepage(){
		$results = array();
		$results['pageTitle'] = "Home | ChemSearch";
		require(TEMPLATES_PATH."/homepage.php");
	}
	
	function search(){
		$results = array();
		$results['pageTitle'] = "Search | ChemSearch";
		require(TEMPLATES_PATH."/search.php");
	}
	
	function resultsChemical(){
		if (!isset($_GET["chemical"]) || !isset($_GET["room"])){
			homepage();
			return;
		}
		
		
		$results['pageTitle'] = "Resuts | ChemSearch";
		require(TEMPLATES_PATH."/resultsChemical.php");
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
		require(TEMPLATES_PATH."/viewChemical.php");
	}
	
?>
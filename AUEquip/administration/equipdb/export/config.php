<?php
	define("ROOT_PATH", "../../../");
	
	require_once(ROOT_PATH."config_pre.php");
	require_once(CLASSES_PATH."DatabaseExporter.php");
	require_once(ROOT_PATH."config_post.php");
	
	$_SESSION['pageTitle'] = "Export Equipment Database";
?>
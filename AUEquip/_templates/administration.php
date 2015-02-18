<?php
	include TEMPLATES_PATH."include/header.php";
	
	require_once(FUNCTIONS_PATH."markup_funcs.php");
	
	echo textLinkUrl("Update the equipment database", "./?action=updateEquipmentDatabase");
	echo "<br />";
	echo "<br />";
	echo textLinkUrl("Access the administrator settings", "./?action=adminSettings");
	
	include TEMPLATES_PATH."include/footer.php";
?>
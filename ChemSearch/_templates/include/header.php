<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title><?php echo htmlspecialchars($_SESSION['pageTitle'])?> | ChemSearch</title>
		<link rel="stylesheet" type="text/css" href="<?php echo STYLESHEETS_PATH."/style.css";?>" />
	</head>
	<body>
		<div id="header"><?php echo htmlspecialchars($_SESSION['pageTitle'])?></div>
		<div id="navigation">
			<a href="<?php echo ROOT_PATH;?>">Home</a><br />
			<br />
			<a href="<?php echo ROOT_PATH;?>search/">Search</a><br />
			<br />
			<a href="<?php echo ROOT_PATH;?>search/chemicals/">Chemicals</a><br />
			<br />
			Location:<br />
			<a href="<?php echo ROOT_PATH;?>search/campus/">- Campus</a><br />
			<a href="<?php echo ROOT_PATH;?>search/buildings/">- Buildings</a><br />
			<a href="<?php echo ROOT_PATH;?>search/rooms/">- Rooms</a><br />
			<br />
			<br />
			<a href="http://jr.chemwatch.net/chemwatch.web/dashboard">ChemWatch</a><br />
			<br />
			<br />
			
			<?php
				if (loggedIn()){
					echo '<a href="'.ROOT_PATH.'administration/">Administration:</a><br />';
					echo '<a href="'.ROOT_PATH.'administration/chemdb/">- Database</a><br />';
					echo '<a href="'.ROOT_PATH.'administration/settings/">- Settings</a><br />';
				}
			?>
		</div>
		<div id="content">
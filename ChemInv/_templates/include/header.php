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
			<a href="<?php echo ROOT_PATH;?>chemsearch/">Search</a><br />
			<br />
			<a href="<?php echo ROOT_PATH;?>chemsearch/chemicals/">Chemicals</a><br />
			<br />
			<a href="<?php echo ROOT_PATH;?>chemsearch/campus/">Campus</a><br />
			<a href="<?php echo ROOT_PATH;?>chemsearch/buildings/">Buildings</a><br />
			<a href="<?php echo ROOT_PATH;?>chemsearch/rooms/">Rooms</a><br />
			<br />
			<br />
			<?php
				if (loggedIn()){
					echo '<a href="'.ROOT_PATH.'administration/">Administration</a><br />';
				}
			?>
		</div>
		<div id="content">
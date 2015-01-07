<?php
	require_once "js_funcs.js";
	
	// Create a text box
	function inputText($label,$name,$size,$initial){
		if($initial != ''){
			$input = '<label>'.$label.' <input type="text" name='.$name.' size='.$size.' value='.$initial.' /></label>';
		}
		else{
			$input = '<label>'.$label.' <input type="text" name='.$name.' size='.$size.' /></label>';
		}
		return $input;
	}
	
	// Create a button
	function inputButton($name,$value){
		return '<input type="submit" name="'.$name.'" value="'.$value.'" />';
	}
	
	// Create a text link to a url
	function textLinkUrl($title,$url){
		
		return '<a href="'.$url.'">'.$title.'</a>';
	}
	
	// Create a text link to a form
	function textLinkForm($title,$form,$field,$value){
		return '<a href="javascript: submit('."'".$form."','".$field."','".$value."'".')">'.$title.'</a>';
	}
	
	// Create the markup for the start of the web page
	function pageStart($title){
		//print start html code
		print '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>';
		if($title != ""){
			print $title;
		}
		else{
			print '????';
		}
		print '</title>
		<link rel="stylesheet" type="text/css" href="style.css" />
	</head>
	<body>';
	}
	
	// Create the markup for the end of the web page
	function pageEnd(){
		// Text links
		print '<br />';
		print '<br />';
		
		print '<form method="POST" action="forms/link_form.php" id="linkform" name="linkform">';
		
		print '<input type="hidden" id="link" name="link" value="">';
		print textLinkForm('Search','linkform','link','search');
		print ' | ';
		print textLinkForm('Browse','linkform','link','browse');
		
		print '</form>';
		
		// End markup
		print '	</body>
</html>';
	}
?>
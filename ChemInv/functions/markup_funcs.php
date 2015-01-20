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
	
	// Create a hidden input
	function inputHidden($name,$value){
		return '<input type="hidden" name="'.$name.'" value="'.$value.'" />';
	}
	
	// Create a text link to a url
	function textLinkUrl($title,$url){
		
		return '<a href="'.$url.'">'.$title.'</a>';
	}
	
	// Create a text link to a form
	function textLinkForm($title,$form,$field,$value){
		return '<a href="javascript: submit('."'".$form."','".$field."','".$value."'".')">'.$title.'</a>';
	}
?>
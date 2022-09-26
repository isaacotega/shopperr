<?php

	$page = array("title" => "Home", "rootPath" => "");
	
	include_once("scripts/php/general-info.php");
	
	include_once("scripts/php/account-info.php");
	
	include_once("scripts/php/functions.php");
	
	include_once("scripts/php/methods.php");
	
	if($user["isSignedIn"]) {
	
		relocate("home");
	
	}
	
	else {
	
		relocate("welcome");
	
	}
	
?>
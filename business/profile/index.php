<?php
	
	$page = array("title" => "", "rootPath" => "../../");
	
	include_once("../../scripts/php/general-info.php");
	
	include_once("../../scripts/php/account-info.php");
	
	include_once("../../scripts/php/functions.php");
	
	include_once("../../scripts/php/methods.php");
	
	
	if($user["isSignedIn"]) {
	
		include("view/registered-viewer.php");
	
	}
	
	else {
	
		include("view/unregistered-viewer.php");
	
	}
	
?>
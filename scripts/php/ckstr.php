<?php
	
	$page = array("rootPath" => "../../");
	
	include("general-info.php");
	
	include("functions.php");
	
	isset($_GET["r"]) or die(relocate("../../"));
	
	$returnPage = isset($_GET["n"]) ? $_GET["n"] : "../../";
	
	
	
	if($_GET["r"] == "set-account-cookie") {
		
		isset($_GET["cookie-code"]) or die(relocate("../"));
	
		setcookie($cookies["account"]["name"], $_GET["cookie-code"], time() + (86400 * $cookies["account"]["lifetime"]), "/");
	
	}
					
	if($_GET["r"] == "delete-account-cookie") {
		
		setcookie($cookies["account"]["name"], "", time() - 1, "/");
	
	}
					
		relocate($returnPage);
		
 ?>
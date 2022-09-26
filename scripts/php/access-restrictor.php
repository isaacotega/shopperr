<?php
	
	include_once($page["rootPath"] . "scripts/php/general-info.php");
		
	include_once($page["rootPath"] . "scripts/php/account-info.php");
		
	include_once($page["rootPath"] . "scripts/php/functions.php");
		
	$restrictInfo = array();
	
	$restrictInfo["isLoggedIn"] = ( isset($_COOKIE[ $cookies["account"]["name"] ]) ) ? true : false;
	
	
	if(isset($page["unrestricted"])) {
	
		if(in_array("accountHolders", $page["unrestricted"])) {
		
			if(!$restrictInfo["isLoggedIn"]) {
						
				relocate($page["rootPath"] . "login?next=" . urlencode("http://" . $_SERVER["HTTP_HOST"]) . $_SERVER["REQUEST_URI"]);
			
			}
		
		}
		
		if(in_array("businessActive", $page["unrestricted"])) {
		
			if(!$user["account"]["isBusinessActive"]) {
						
				relocate($page["rootPath"] . "home");
			
			}
		
		}
	
	}
	
 ?>
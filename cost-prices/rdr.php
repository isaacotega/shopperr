<?php
	
	$page = array("rootPath" => "../", "unrestricted" => array("accountHolders", "businessActive") );
	
	include_once("../scripts/php/functions.php");
	
	include_once("../scripts/php/general-info.php");
	
	include_once("../scripts/php/account-info.php");
	
	include_once("../scripts/php/methods.php");
	
	
	$itemId = $_GET["item-id"];
	
	$destination = $_GET["destination"];
	
	if($destination == "market-list") {
		
		foreach($user["account"]["activeBusiness"]["marketListsIds"] as $eachListId) {
		
			foreach(marketListDetails($eachListId)["itemsIds"] as $eachItemId) {
				
				if($eachItemId == $itemId) {
					
					relocate("../market-list?id=" . $eachListId);
				
					break;
				
				}
			
			}
		
		}
	
	
	
	}
	
 ?>
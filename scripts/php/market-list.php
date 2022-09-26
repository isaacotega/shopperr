<?php
	
	$page = array("title" => "", "rootPath" => "../../", "unrestricted" => array("accountHolders", "businessActive") );
	
	include_once("functions.php");
	
	include_once("methods.php");
	
	include_once("connection.php");
	
	include_once("general-info.php");
	
	include_once("account-info.php");
	
	isset($_GET["request"]) or die(relocate("../../"));
	
	$request = $_GET["request"];
	
	$date = date("Y m d");
		
	$time = date("h:i");
	
		
	if($request == "add-item") {
	
		$newItemObj = json_decode($_GET["obj"], true);
		
		$listId = $_GET["list-id"];
		
		$itemId = "";
						
		for($i = 0; $i < 20; $i++) {
						
			$itemId .= rand(0, 9);
						
		}
		
		$goodsName = $newItemObj["good"];
		
		$quantity = $newItemObj["quantity"];
		
		$budget = $newItemObj["budget"];
		
		if(marketListDetails($listId)["user"]["isActive"]) {
		
			$costPrice = $newItemObj["costPrice"];
		
			$store = $newItemObj["store"];
		
			$notes = $newItemObj["notes"];
		
			$sql = "INSERT INTO market_list_items (item_id, list_id, goods_name, quantity, budget, cost_price, store, notes, date_added, time_added) VALUES ('$itemId', '$listId', '$goodsName', '$quantity', '$budget', '$costPrice', '$store', '$notes', '$date', '$time') ";
		
		}
		
		else {
		
		$sql = "INSERT INTO market_list_items (item_id, list_id, goods_name, quantity, budget, date_added, time_added) VALUES ('$itemId', '$listId', '$goodsName', '$quantity', '$budget', '$date', '$time') ";
		
		}
		
		
		if(mysqli_query($conn, $sql)) {
		
			toast("Item added successfully!");
		
			relocate("../../market-list?id=" . $listId);
		
		}
		
	}
	
	if($request == "edit-item") {
	
		$editedItemObj = json_decode($_GET["obj"], true);
		
		$listId = $_GET["list-id"];
		
		$itemId = $_GET["item-id"];
		
		$goodsName = $editedItemObj["good"];
		
		$quantity = $editedItemObj["quantity"];
		
		$budget = $editedItemObj["budget"];
		
		
		if(marketListDetails($listId)["user"]["isActive"]) {
		
			$costPrice = $editedItemObj["costPrice"];
		
			$store = $editedItemObj["store"];
		
			$notes = $editedItemObj["notes"];
		
			$sql = "UPDATE market_list_items SET goods_name = '$goodsName', quantity = '$quantity', budget = '$budget', cost_price = '$costPrice', store = '$store', notes = '$notes' WHERE list_id = '$listId' AND item_id = '$itemId' ";
		
		}
		
		else {
		
			$sql = "UPDATE market_list_items SET goods_name = '$goodsName', quantity = '$quantity', budget = '$budget' WHERE list_id = s$'$listId' AND item_id = '$itemId' ";
			
		}
		
		if(mysqli_query($conn, $sql)) {
		
			toast("Item edited successfully!");
		
			relocate("../../market-list?id=" . $listId);
		
		}
		
	}
	
	if($request == "activate-list") {
	
		$listId = $_GET["list-id"];
		
		(!marketListDetails($listId)["user"]["isActive"]) or die(relocate("../../"));
		
		$sql = "INSERT INTO active_market_lists (list_id, usercode, date_activated, time_activated) VALUES ('$listId', '" . $user["account"]["usercode"] . "', '$date', '$time') ";
		
		if(mysqli_query($conn, $sql)) {
		
			toast("Market list, " . marketListDetails($listId)["title"] . " activated successfully!");
			
			relocate("../../market-list?id=" . $listId);
		
		}
		
	}
	
	if($request == "deactivate-list") {
	
		$listId = $_GET["list-id"];
		
		(marketListDetails($listId)["user"]["isActive"]) or die(relocate("../../"));
		
		$sql = "DELETE FROM active_market_lists WHERE list_id = '$listId' AND usercode  = '" . $user["account"]["usercode"] . "' ";
		
		if(mysqli_query($conn, $sql)) {
		
			toast("Market list, " . marketListDetails($listId)["title"] . " deactivated successfully!");
			
			relocate("../../market-list?id=" . $listId);
		
		}
		
	}
	
	if($request == "delete-item") {
	
		$listId = $_GET["list-id"];
		
		$itemId = $_GET["item-id"];
		
		(marketListDetails($listId)["user"]["isAuthorized"]) or die(relocate("../../"));
		
		$sql = "DELETE FROM market_list_items WHERE list_id = '$listId' AND item_id  = '" . $itemId. "' ";
		
		if(mysqli_query($conn, $sql)) {
		
			toast("Item deleted successfully!");
			
			relocate("../../market-list?id=" . $listId);
		
		}
		
	}
	
	if($request == "delete-list") {
		
		$listId = $_GET["list-id"];
		
		(marketListDetails($listId)["user"]["isAuthorized"]) or die(relocate("../../"));
		
		$listName = marketListDetails($listId)["title"];
	
		$sql = "DELETE FROM active_market_lists WHERE list_id = '$listId' ";
		
		mysqli_query($conn, $sql);
		
		$sql = "DELETE FROM market_lists WHERE list_id = '$listId' ";
		
		if(mysqli_query($conn, $sql)) {
		
			toast("Market List, " . $listName . " deleted successfully!");
			
			relocate("../../market-list/list");
		
		}
		
	}
	
	if($request == "clear-list") {
	
		$listId = $_GET["list-id"];
		
		$sql = "DELETE FROM active_market_lists WHERE list_id = '$listId' ";
		
		mysqli_query($conn, $sql);
		
		$sql = "UPDATE market_lists SET status = 'cleared' WHERE list_id = '$listId' ";
		
		if(mysqli_query($conn, $sql)) {
		
			toast("Market list, " . marketListDetails($listId)["title"] . " cleared successfully!");
		
			relocate("../../market-list?id=" . $listId);
		
		}
		
	}
	
 ?>
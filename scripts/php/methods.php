<?php

	require_once("connection.php");
	
	include_once("general-info.php");
	
	include_once("account-info.php");
	
	function icon($name, $type) {
		
		global $page;
	
		switch($type) {
		
			case "svg" :
			
				return file_get_contents($page["rootPath"] . "icons/" . $name . ".svg");
				
				break;
				
			case "image" :
			
				return file_get_contents($page["rootPath"] . "icons/" . $name . ".jpg");
				
				break;
				
			default :
			
				return file_get_contents($page["rootPath"] . "icons/" . $name . ".svg");
				
				
		}
	
	}
	
	function businessDetails($businessId) {
		
		global $conn, $page, $app;
		
		$sql = "SELECT * FROM businesses WHERE business_id = '$businessId' ";
		
		if($result = mysqli_query($conn, $sql)) {
		
			$row = mysqli_fetch_array($result);
			
			$businessDetails = array();
			
			$businessDetails["exists"] = ((mysqli_num_rows($result) !== 0) ? true : false);
			
			$businessDetails["id"] = $row["business_id"];
		
			$businessDetails["name"] = $row["business_name"];
		
			$businessDetails["address"] = $row["address"];
			
			$businessDetails["motto"] = $row["motto"];
			
			$businessDetails["originalProfilePictureSrc"] = $page["rootPath"] . "uploads/images/business/profile-pictures/" . $businessDetails["id"] . ".jpg";		
				
			$businessDetails["profilePictureSrc"] = file_exists($businessDetails["originalProfilePictureSrc"]) ? $businessDetails["originalProfilePictureSrc"] : $app["defaults"]["images"]["business"]["profilePicture"];		
			
			return $businessDetails;
	
		}
		
	}
	
	function accountDetails($usercode) {
		
		global $conn;
		
		$sql = "SELECT * FROM accounts WHERE usercode = '$usercode' ";
		
		if($result = mysqli_query($conn, $sql)) {
		
			$row = mysqli_fetch_array($result);
			
			$accountDetails = array();
			
			$accountDetails["usercode"] = $row["usercode"];
		
			$accountDetails["username"] = $row["username"];
		
			$accountDetails["emailAddress"] = $row["email_address"];
		
			return $accountDetails;
	
		}
		
	}
	
	function emailInformation($emailAddress) {
	
		global $conn;
		
		$emailInformation = array();
			
		$sql = "SELECT * FROM accounts WHERE email_address = '$emailAddress' ";
		
		if($result = mysqli_query($conn, $sql)) {
			
			$row = mysqli_fetch_array($result);
		
			$emailInformation["isRegistered"] = ((mysqli_num_rows($result) == 0) ? false : true);
			
			if($emailInformation["isRegistered"]) {
		
				$emailInformation["account"] = array();
			
				$emailInformation["account"]["username"] = $row["username"];
		
			}
		
		}
		
		return $emailInformation;
	
	}
	
	function marketListDetails($listId) {
		
		global $conn, $user;
		
		$sql = "SELECT * FROM market_lists WHERE list_id = '$listId' ";
		
		if($result = mysqli_query($conn, $sql)) {
		
			$row = mysqli_fetch_array($result);
			
			$marketListDetails = array();
			
			$marketListDetails["exists"] = ((mysqli_num_rows($result) == 0) ? false : true);
			
			$marketListDetails["listId"] = $row["list_id"];
		
			$marketListDetails["businessId"] = $row["business_id"];
			
			$marketListDetails["title"] = $row["title"];
		
			$marketListDetails["creatorUsercode"] = $row["creator_usercode"];
		
			$marketListDetails["scheduledDate"] = $row["scheduled_date"];
		
			$marketListDetails["scheduledTime"] = $row["scheduled_time"];
		
			$marketListDetails["status"] = $row["status"];
		
			$marketListDetails["is"]["cleared"] = (($marketListDetails["status"] == "cleared") ? true : false);
			
			$marketListDetails["dateCreated"] = $row["date_created"];
		
			$marketListDetails["timeCreated"] = $row["time_created"];
			
			$sql = "SELECT * FROM business_admins WHERE business_id = '" . $marketListDetails["businessId"] . "' AND admin_usercode = '" . $user["account"]["usercode"] . "' ";
			
			if($result = mysqli_query($conn, $sql)) {
			
				$marketListDetails["user"]["isAuthorized"] = ((mysqli_num_rows($result) == 0) ? false : true);
			
			}
		
			$sql = "SELECT * FROM market_list_items WHERE list_id = '" . $marketListDetails["listId"] . "' ";
			
			if($result = mysqli_query($conn, $sql)) {
			
				$marketListDetails["itemsIds"] = array();
					
				while($row = mysqli_fetch_array($result)) {
			
					$marketListDetails["itemsIds"][] = $row["item_id"];
					
				}
			
			}
		
			$sql = "SELECT * FROM active_market_lists WHERE list_id = '" . $marketListDetails["listId"] . "' AND usercode = '" . $user["account"]["usercode"] . "' ";
			
			if($result = mysqli_query($conn, $sql)) {
			
				$marketListDetails["user"]["isActive"] = (mysqli_num_rows($result) !== 0);
			
			}
		
			return $marketListDetails;
	
		}
		
	}
	
	function marketListItemsDetails($itemId) {
		
		global $conn, $user;
		
		$sql = "SELECT * FROM market_list_items WHERE item_id = '$itemId' ";
		
		if($result = mysqli_query($conn, $sql)) {
		
			$row = mysqli_fetch_array($result);
			
			$marketListItemsDetails = array();
			
			$marketListItemsDetails["exists"] = ((mysqli_num_rows($result) == 0) ? false : true);
			
			$marketListItemsDetails["itemId"] = $row["item_id"];
		
			$marketListItemsDetails["list_Id"] = $row["list_id"];
			
			$marketListItemsDetails["goodsName"] = $row["goods_name"];
		
			$marketListItemsDetails["quantity"] = $row["quantity"];
		
			$marketListItemsDetails["budget"] = $row["budget"];
		
			$marketListItemsDetails["costPrice"] = $row["cost_price"];
		
			$marketListItemsDetails["store"] = $row["store"];
		
			$marketListItemsDetails["notes"] = $row["notes"];
		
			$marketListItemsDetails["dateAdded"] = $row["date_added"];
		
			$marketListItemsDetails["timeAdded"] = $row["time_added"];
		
		}
		
		return $marketListItemsDetails;
		
	}
	
	function goodDetails($goodId) {
		
		global $conn, $user;
		
		$sql = "SELECT * FROM goods WHERE good_id = '$goodId' ";
		
		if($result = mysqli_query($conn, $sql)) {
		
			$row = mysqli_fetch_array($result);
			
			$goodDetails = array();
			
			$goodDetails["exists"] = ((mysqli_num_rows($result) == 0) ? false : true);
			
			$goodDetails["goodId"] = $row["good_id"];
		
			$goodDetails["businessId"] = $row["business_id"];
			
			$goodDetails["adderUsercode"] = $row["adder_usercode"];
		
			$goodDetails["name"] = $row["name"];
		
			$goodDetails["dateAdded"] = $row["date_added"];
		
			$goodDetails["timeAdded"] = $row["time_added"];
		
			return $goodDetails;
	
		}
		
	}
	
	function credebtorsDetails($uniqueId) {
		
		global $conn, $user;
		
		$sql = "SELECT * FROM credebtors WHERE unique_id = '$uniqueId' ";
		
		if($result = mysqli_query($conn, $sql)) {
		
			$row = mysqli_fetch_array($result);
			
			$credebtorsDetails = array();
			
			$credebtorsDetails["exists"] = ((mysqli_num_rows($result) == 0) ? false : true);
			
			$credebtorsDetails["type"] = $row["type"];
		
			$credebtorsDetails["recordId"] = $row["record_id"];
			
			$credebtorsDetails["businessId"] = $row["business_id"];
			
			$credebtorsDetails["recorderUsercode"] = $row["recorder_usercode"];
			
			$credebtorsDetails["recorderUsername"] = accountDetails($row["recorder_usercode"])["username"];
			
			$credebtorsDetails["credebtorsName"] = $row["credebtors_name"];
		
			$credebtorsDetails["goodsBought"] = $row["goods_bought"];
		
			$credebtorsDetails["amount"] = $row["amount"];
		
			$credebtorsDetails["notes"] = $row["notes"];
			
			$credebtorsDetails["status"] = $row["status"];
		
			$credebtorsDetails["striked"] = $row["striked"];
			
			$credebtorsDetails["strikerUsercode"] = $row["striker_usercode"];
		
			$credebtorsDetails["strikerUsername"] = accountDetails($row["striker_usercode"])["username"];
			
			$credebtorsDetails["dateAdded"] = $row["date_added"];
		
			$credebtorsDetails["timeAdded"] = $row["time_added"];
		
			$credebtorsDetails["dateOverwritten"] = $row["date_overwritten"];
		
			$credebtorsDetails["timeOverwritten"] = $row["time_overwritten"];
		
			return $credebtorsDetails;
	
		}
		
	}
	
	function receiptDetails($receiptId) {
		
		global $conn, $user;
		
		$sql = "SELECT * FROM receipts WHERE receipt_id = '$receiptId' ";
		
		if($result = mysqli_query($conn, $sql)) {
		
			$row = mysqli_fetch_array($result);
			
			$receiptDetails = array();
			
			$receiptDetails["exists"] = ((mysqli_num_rows($result) == 0) ? false : true);
			
			$receiptDetails["receiptId"] = $row["receipt_id"];
		
			$receiptDetails["businessId"] = $row["business_id"];
			
			$receiptDetails["creatorUsercode"] = $row["creator_usercode"];
		
			$receiptDetails["creatorUsername"] = accountDetails($row["creator_usercode"])["username"];
		
			$receiptDetails["issuerUsercode"] = $row["issuer_usercode"];
		
			$receiptDetails["printsNumber"] = $row["prints_number"];
		
			$receiptDetails["issued"] = $row["issued"];
		
			$receiptDetails["dateCreated"] = $row["date_created"];
		
			$receiptDetails["timeCreated"] = $row["time_created"];
		
			$receiptDetails["dateIssued"] = $row["date_issued"];
		
			$receiptDetails["timeIssued"] = $row["time_issued"];
		
			$receiptDetails["pageNumber"] = 0;
		
			$sql = "SELECT * FROM receipts WHERE business_id = '" . $user["account"]["activeBusiness"]["id"] . "' ORDER BY date_created, time_created ";
		
			if($result = mysqli_query($conn, $sql)) {
		
				while($row = mysqli_fetch_array($result)) {
				
					$receiptDetails["pageNumber"] += 1;
					
					if($row["receipt_id"] == $receiptDetails["receiptId"]) {
						
						break;
						
					}
				
				}
			
			}
		
			return $receiptDetails;
	
		}
		
	}
	
 ?>
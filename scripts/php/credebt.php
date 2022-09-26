<?php
	
	$page = array("title" => "", "rootPath" => "../../", "unrestricted" => array("accountHolders", "businessActive") );
	
	include_once("functions.php");
	
	include_once("methods.php");
	
	include_once("connection.php");
	
	include_once("general-info.php");
	
	include_once("account-info.php");
	
	isset($_GET["request"]) or die(relocate("../../"));
	
	$request = $_GET["request"];
	
	$type = $_GET["type"];
	
	$date = date("Y m d");
		
	$time = date("h:i");
	
		
	if($request == "add-record") {
	
		$newRecordObj = json_decode($_GET["obj"], true);
		
		$recordId = "";
					
		$uniqueId = "";
						
		for($i = 0; $i < 20; $i++) {
						
			$recordId .= rand(0, 9);
			
			$uniqueId .= rand(0, 9);
						
		}
	
		$credebtorsName = $newRecordObj["credebtorsName"];
		
		$goodsBought = $newRecordObj["goodsBought"];
		
		$amount = $newRecordObj["amount"];
		
		$note = $newRecordObj["note"];
		
		$sql = "INSERT INTO credebtors (type, record_id, unique_id, business_id, recorder_usercode, credebtors_name, goods_bought, amount, notes, status, date_added, time_added) VALUES ('$type', '$recordId', '$uniqueId', '" . $user["account"]["activeBusiness"]["id"] . "', '" . $user["account"]["usercode"] . "', '$credebtorsName', '$goodsBought', '$amount', '$note', 'latest', '$date', '$time') ";
		
		if(mysqli_query($conn, $sql)) {
		
			toast($type . " record added successfully!");
		
			relocate("../../" . $type);
		
		}
		
	}
	
	
	if($request == "edit-record") {
			
		$uniqueId = "";
					
		for($i = 0; $i < 20; $i++) {
						
			$uniqueId .= rand(0, 9);
						
		}
	
		$recordId = $_GET["record-id"];
	
		$editedRecordObj = json_decode($_GET["obj"], true);
		
		$credebtorsName = $editedRecordObj["credebtorsName"];
		
		$goodsBought = $editedRecordObj["goodsBought"];
		
		$amount = $editedRecordObj["amount"];
		
		$note = $editedRecordObj["note"];
		
		$sql = "UPDATE credebtors SET status = 'overwritten', date_overwritten = '$date', time_overwritten = '$time' WHERE record_id = '$recordId' ";
		
		mysqli_query($conn, $sql);
		
		$sql = "INSERT INTO credebtors (type, record_id, unique_id, business_id, recorder_usercode, credebtors_name, goods_bought, amount, notes, status, date_added, time_added) VALUES ('$type', '$recordId', '$uniqueId', '" . $user["account"]["activeBusiness"]["id"] . "', '" . $user["account"]["usercode"] . "', '$credebtorsName', '$goodsBought', '$amount', '$note', 'latest', '$date', '$time') ";
		
		if(mysqli_query($conn, $sql)) {
		
			toast($type . " record edited successfully!");
		
			relocate("../../" . $type);
		
		}
		
	}
	
	
	if($request == "strike") {
			
		$recordId = $_GET["record-id"];
	
		$sql = "UPDATE credebtors SET striked = 'true', striker_usercode = '" . $user["account"]["usercode"] . "', date_striked = '$date', time_striked = '$time' WHERE record_id = '$recordId' ";
		
		if(mysqli_query($conn, $sql)) {
		
			toast("Striked!");
		
			relocate("../../" . $type);
		
		}
		
	}
	
 ?>
<?php
	
	$page = array("rootPath" => "../../", "unrestricted" => array("accountHolders", "businessActive") );
	
	include_once("functions.php");
	
	include_once("methods.php");
	
	include_once("connection.php");
	
	include_once("general-info.php");
	
	include_once("account-info.php");
	
	isset($_GET["request"]) or die(relocate("../../"));
	
	$request = $_GET["request"];
	
	$date = date("Y m d");
		
	$time = date("h:i");
	
	
	
	
	if($request == "new") {
		
		$date = date("Y m d");
		
		$time = date("h:i");
		
		$receiptId = "";						
						
		for($i = 0; $i < 20; $i++) {
						
			$receiptId .= rand(0, 9);
						
		}
			
		$sql = "INSERT INTO receipts (receipt_id, business_id, creator_usercode, date_created, time_created) VALUES ('$receiptId', '" . $user["account"]["activeBusiness"]["id"] . "', '" . $user["account"]["usercode"] . "', '$date', '$time') ";
				
			if(mysqli_query($conn, $sql)) {
					
				relocate("../../receipts?id=" . $receiptId);
				
			}
	echo mysqli_error($conn);
		}
		
?>
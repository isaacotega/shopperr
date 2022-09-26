<?php
	
	$page = array("title" => "", "rootPath" => "../../", "unrestricted" => array("accountHolders") );
	
	include_once("general-info.php");
	
	include_once("account-info.php");
	
	include_once("functions.php");
	
	include_once("methods.php");
	
	include_once("connection.php");
	
	
	isset($_GET["request"]) or die(relocate("../../"));
	
	$request = $_GET["request"];
	
	
	if($request == "switch-active-business") {
	
		isset($_GET["id"]) or die(relocate("../../"));
	
		$id = $_GET["id"];
	
		$sql = "SELECT * FROM business_admins WHERE business_id = '$id' AND admin_usercode = '" . $user["account"]["usercode"] . "' AND active = 'true' ";
	
		if($result = mysqli_query($conn, $sql)) {
	
			(mysqli_num_rows($result) !== 0) or die(relocate("../../"));
		
			$sql = "UPDATE accounts SET active_business_id = '$id' WHERE usercode = '" . $user["account"]["usercode"] . "' ";
		
			if(mysqli_query($conn, $sql)) {
		
				include_once("../../templates/header.php");
	
				toast("Active business switched to " . businessDetails($id)["name"]);
			
				relocate("../../");
		
			}
	
		}
		
	}
	
	
	if($request == "logout") {
	
		$sql = "UPDATE accounts SET active_business_id = '' WHERE usercode = '" . $user["account"]["usercode"] . "' ";
		
		if(mysqli_query($conn, $sql)) {
		
		 	relocate("../../");
		
		}
		
	}
	
	
	if($request == "accept-business-admin-invitation") {
		
		$businessId = $_GET["id"];
	
		$date = date("Y m d");
		
		$time = date("h:i");
		
		$sql = "SELECT * FROM admin_invitations WHERE business_id ='$businessId' AND invited_email_address = '" . $user["account"]["emailAddress"] . "' AND accepted = 'false' ";
		
		if($result = mysqli_query($conn, $sql)) {
		
			(mysqli_num_rows($result) !== 0) or die(relocate("../../"));
		
		}
		
		$sql = "UPDATE admin_invitations SET accepted = 'true' WHERE business_id ='$businessId' AND invited_email_address = '" . $user["account"]["emailAddress"] . "' ";
		
		mysqli_query($conn, $sql);
			
		$sql = "INSERT INTO business_admins (business_id, admin_usercode, admin_type, active, date_added, time_added) VALUES ('$businessId', '" . $user["account"]["usercode"] . "', '2', 'true', '$date', '$time')";
				
		mysqli_query($conn, $sql);
		
		toast("You are now an admin of " . businessDetails($businessId)["name"]);
		
		relocate("../../business");
		
	}
	
	
	
 ?>
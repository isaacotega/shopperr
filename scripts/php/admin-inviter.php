<?php
	
	session_start();
	
	$page = array("rootPath" => "../../", "unrestricted" => array("accountHolders") );
	
	include_once("connection.php");
	
	include_once("general-info.php");
	
	include_once("account-info.php");
	
	include_once("functions.php");
	
	include_once("methods.php");
	
	isset($_POST["emailAddress"]) or die(relocate("../.../"));
	
	$emailAddress = $_POST["emailAddress"];
	
	$invitationCode = "";
	
	for($i = 0; $i < 20; $i++) {
						
		$invitationCode .= rand(0, 9);
						
	}
	
	$inviterUsercode = $user["account"]["usercode"];
	
	$businessId = $user["account"]["activeBusiness"]["id"];
	
	$date = date("Y m d");
	
	$time = date("H:i");
	
	$sql = "INSERT INTO admin_invitations (inviter_usercode, invited_email_address, business_id, date, time) VALUES ('$inviterUsercode', '$emailAddress', '$businessId', '$date', '$time') ";
	
	if($user["account"]["exceededDailyLimit"]["adminInvitations"]) {
		
		toast("You have exceeded the daily limit of " . $app["dailyLimits"]["adminInvitations"] . " admin invitations.");
	
		die(relocate("../../business/active/admins"));
	
	}
	
	mysqli_query($conn, $sql);
	
	toast("$emailAddress invited successfully");
	
	if(emailInformation($emailAddress)["isRegistered"]) {
	
		$receiversName = emailInformation($emailAddress)["account"]["username"];
	
	}
	
	else {
		
		$receiversName = $emailAddress;
	
	}
						
	$_SESSION["mailInfo"] = array(
		"mailOk" => true,
		"mailType" => "adminInvitation",
		"emailAddress" => $emailAddress,
		"invitationCode" => $invitationCode,
		"returnPageUri" => "business/active/admins",
		"invitedIsRegistered" => emailInformation($emailAddress)["isRegistered"],
		"receiversName" => $receiversName
	);
	
	relocate("mailer.php");
	
 ?>
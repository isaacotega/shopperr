<?php
		
	session_start();
	
	$page = array("title" => "", "rootPath" => "../../");
	
	include_once("general-info.php");
	
	include_once("account-info.php");
	
	include_once("functions.php");
	
	include_once("methods.php");
	
	include_once("connection.php");
	
	
	isset($_GET["request"]) or die(relocate("../../"));
	
	$request = $_GET["request"];
	
	$date = date("Y m d");
		
	$time = date("h:i");
	
	
	if($request == "initialize-mail-info") {
	
		isset($_SESSION["loginDetails"]["email"]) or die(relocate("../../"));
	
		$email = $_SESSION["loginDetails"]["email"];
	
		$sql = "SELECT * FROM accounts WHERE email_address =  '$email' ";
		
		if($result = mysqli_query($conn, $sql)) {
			
			$row = mysqli_fetch_array($result);
		
			$usercode = $row["usercode"];
		
		}
			
		$accessCode = "";						
						
		for($i = 0; $i < 20; $i++) {
						
			$accessCode .= rand(0, 9);
						
		}
			
		$sql = "UPDATE pending_password_resets SET active = 'false' WHERE recoverer_usercode = '$usercode' ";
		
		mysqli_query($conn, $sql);
			
		$sql = "INSERT INTO pending_password_resets (recoverer_usercode, access_code, date_requested, time_requested) VALUES ('$usercode', '$accessCode', '$date', '$time') ";
		
		if(mysqli_query($conn, $sql)) {
			
			toast("Email reset link sent successfully!");
					
			$_SESSION["mailInfo"] = array("mailOk" => true, "mailType" => "passwordRecovery", "emailAddress" => $email, "returnPageUri" => "recover/confirm-email", "usercode" => $usercode);
			
			relocate("mailer.php");
						
		}
		
	}
	
 ?>
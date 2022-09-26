<?php
	
	session_start();
	
	$page = array("rootPath" => "../../");
	
	include("connection.php");
	
	include("functions.php");
	
	include("methods.php");
	
	include("general-info.php");
	
	include("account-info.php");
	
	isset($_SESSION["mailInfo"]) or die(relocate("../../"));
	
	($_SESSION["mailInfo"]["mailOk"]) or die(relocate("../../"));
	
	$mailSender = "shopperr@ovolisky.com.ng";
	
	$mailType = $_SESSION["mailInfo"]["mailType"];
	
	$receiversMail = $_SESSION["mailInfo"]["emailAddress"];
	
	$returnPage = $_SESSION["mailInfo"]["returnPageUri"];
	
	
	$headers = "From: " . $app["appName"] . " " . $mailSender . "\r\n";
						
	$headers .= "To: " . $receiversMail . "\r\n";
						
	$headers .= "MIME-Version: 1.0\r\n";
						
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
					
	
	if($mailType == "emailConfirmation") {
		
		$emailConfirmationCode = $_SESSION["mailInfo"]["confirmationCode"];
	
		$subject = "Confirm Email Address";
						
		$items = array("@receiversMail", "@appName", "@fullUrl");
						
		$replacements = array($receiversMail, $app["appName"], "http://" . $app["baseUrl"]  . "/confirm-email?id=" . $emailConfirmationCode);
						
		$message = str_replace($items, $replacements, file_get_contents("../../templates/emails/signup-confirmation.html"));
		
		$date = date("Y m d");
		
		$sql = "SELECT * FROM emails_pending_confirmation WHERE confirmation_code = '$emailConfirmationCode' ";
		
		if($result = mysqli_query($conn, $sql)) {
		
			$row = mysqli_fetch_array($result);
			
			$lastMailDate = $row["last_mail_date"];
			
			$mailNumber = $row["mail_number"];
			
			if($date == $lastMailDate && $mailNumber > 2) {
			
				die(relocate($page["rootPath"] . $returnPage . "?mail-exceeded"));
			
			}
		
		}
		
		$sql = "UPDATE emails_pending_confirmation SET last_mail_date = '$date', mail_number = (mail_number + 1) WHERE confirmation_code = '$emailConfirmationCode' ";
		
		mysqli_query($conn, $sql);
		
	}
						
	if($mailType == "adminInvitation") {
		
		$invitationCode = $_SESSION["mailInfo"]["invitationCode"];
	
		$receiversName = $_SESSION["mailInfo"]["receiversName"];
	
		$subject = "Admin Invitation";
						
		$items = array("@inviterName", "@receiversName", "@businessName", "@receiversMail", "@appName", "@fullUrl", "@playStoreLink");
						
		$replacements = array($user["account"]["username"], $receiversName, $user["account"]["activeBusiness"]["name"], $receiversMail, $app["appName"], "http://" . $app["baseUrl"]  . "/accept-invitation?id=" . $invitationCode, $app["links"]["download"]["googlePlayStore"]);
		
		$invitationEmailFile = ($_SESSION["mailInfo"]["invitedIsRegistered"] ? "admin-invitation-registered.html" : "admin-invitation-unregistered.html");
						
		$message = str_replace($items, $replacements, file_get_contents("../../templates/emails/" . $invitationEmailFile));
		
		$date = date("Y m d");
		
	}
				
	if($mailType == "passwordRecovery") {
	
		$usercode = $_SESSION["mailInfo"]["usercode"];
		
		$sql = "SELECT * FROM pending_password_resets WHERE recoverer_usercode = '$usercode' AND active = 'true' ";
		
		if($result = mysqli_query($conn, $sql)) {
		
			$row = mysqli_fetch_array($result);
		
			$accessCode = $row["access_code"];
				
		}
		
		else echo mysqli_error($conn);
		
		$receiversMail = accountDetails($usercode)["emailAddress"];
	
		$subject = "Reset Password";
						
		$items = array("@receiversMail", "@appName", "@fullUrl");
						
		$replacements = array($receiversMail, $app["appName"], "http://" . $app["baseUrl"]  . "/recover/reset-password?id=" . $accessCode);
							
		$message = str_replace($items, $replacements, file_get_contents("../../templates/emails/password-reset.html"));
		
	}
						
			
	
	mail($receiversMail, $subject, $message, $headers, "-f " . $mailSender);
	
	$_SESSION["mailInfo"]["mailOk"] = false;
	
	relocate($page["rootPath"] . $returnPage);
						
 ?>
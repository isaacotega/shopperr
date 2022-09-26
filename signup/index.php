<?php
	
	session_start();
	
	$page = array("title" => "Sign up", "rootPath" => "../");
	
	include_once("../templates/header.php");
	
	if(isset($_POST["submit"])) {
		
		if(!empty($_POST["email"])) {
	
		require("../scripts/php/connection.php");
		
		$email = $_POST["email"];
		
		$date = date("Y m d");
		
		$time = date("H:i");
		
		$sql = "SELECT * FROM accounts WHERE email_address = '$email' ";
		
		if($result = mysqli_query($conn, $sql)) {
		
			if(mysqli_num_rows($result) == 0) {
			
				$sql = "SELECT * FROM emails_pending_confirmation WHERE email_address = '$email' ";
		
				if($result = mysqli_query($conn, $sql)) {
		
					if(mysqli_num_rows($result) == 0) {
						
						$confirmationCode = "";						
						
						for($i = 0; $i < 20; $i++) {
						
							$confirmationCode .= rand(0, 9);
						
						}
						
						$sql = "INSERT INTO emails_pending_confirmation(email_address, confirmation_code, date, time) VALUES ('$email', '$confirmationCode', '$date', '$time') ";
						
						if(mysqli_query($conn, $sql)) {
						
							$_SESSION["mailInfo"] = array("mailOk" => true, "mailType" => "emailConfirmation", "emailAddress" => $email, "confirmationCode" => $confirmationCode, "returnPageUri" => "pages/confirm-email");
							
							relocate("../scripts/php/mailer.php");
						
						}
						
					}
			
					else {
			
						relocate("../pages/confirm-email");
			
					}
					
				}
			
			}
			
			else {
			
				toast("This email address has already been registered");
			
			}
		
		}
		
		}
		
		else {
		
			toast("Please fill in the details");
		
		}
	
	}
	
?>

<link rel="stylesheet" type="text/css" href="../styles/account-page.css">

<script src="../scripts/js/account-page.js"></script>

<div id="main">

  <form method="post" class="form" autocomplete="off">
 
 	<br><br>
 
 	<label class="formHeading">Sign up for <?php echo $app["appName"]; ?></label>
 	
 	<br>
 	
	 <div class="formError">
	 
	 	<label></label>
	 
	 </div>
 	
 	<br><br><br><br><br>
 
 	<input type="email" name="email" placeholder="Enter Email Address" class="input">
 
 	<br><br><br><br><br>
 	
 	<br><br>
 	
 	<input type="submit" name="submit" class="submit" value="Sign Up">
 	
 	<br><br><br><br><br>
 	
	 <label class="formLabel">Already have an account?</label>
	 	
 	<br><br>
 	
 	<a href="../login">
 	
 		<button type="button" class="otherButton">Log In</button>
 		
 	</a>
 	
 	<br><br>
 
 </form>
 
</div>

<?php

	include("../templates/footer.php");
	
?>
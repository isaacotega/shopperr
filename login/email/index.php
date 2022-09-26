<?php
	
	session_start();
	
	$page = array("title" => "Sign in", "rootPath" => "../../");
	
	include("../../templates/header.php");
	
	require("../../scripts/php/connection.php");
	
	
	if(isset($_POST["submit"])) {
	
		if(!empty($_POST["email"])) {
	
			$email = $_POST["email"];
	
			$sql = "SELECT * FROM accounts WHERE email_address = '$email' ";
			
			if($result = mysqli_query($conn, $sql)) {
			
				if(mysqli_num_rows($result) == 0) {
				
					$sql = "SELECT * FROM emails_pending_confirmation WHERE email_address = '$email' ";
					
					if($result = mysqli_query($conn, $sql)) {
					
						if(mysqli_num_rows($result) !== 0) {
							
							$row = mysqli_fetch_array($result);
							
							$confirmationCode = $row["confirmation_code"];
				
							$_SESSION["mailInfo"] = array("mailOk" => false, "mailType" => "emailConfirmation", "emailAddress" => $email, "confirmationCode" => $confirmationCode, "returnPageUri" => "pages/confirm-email");
			
							relocate("../../pages/confirm-email");
						
						}
						
						else {
						
							toast("No account exists with this email address");
						
						}
					
					}
				
				}
				
				else {
				
					$row = mysqli_fetch_array($result);
					
					$usercode = $row["usercode"];
					
					$password = $row["password"];
					
					if(empty($password)) {
						
						$_SESSION["uncompletedAccount"] = array("usercode" => $usercode);
					
						relocate("../../complete-account");
					
					}
					
					else {
						
						$_SESSION["loginDetails"] = array("email" => $email);
						
						if(isset($_GET["next"])) {
						
							relocate("../password?next=" . urlencode($_GET["next"]));
						
						}
						
						else {
					
							relocate("../password");
						
						}
					
					}
				
				}
			
			}
	
		}
		
		else {
		
			toast("Please fill in the details");
		
		}
	
	}
	
?>

<link rel="stylesheet" type="text/css" href="../../styles/account-page.css">

<script src="../../scripts/js/account-page.js"></script>

<div id="main">

  <form method="post" class="form" id="frmLogin" autocomplete="off">
 
 	<br><br>
 
 	<label class="formHeading">Enter email address</label>
 	
 	<br><br><br><br>
 	
 	<input type="email" name="email" placeholder="Enter Email Address" class="input" id="inpEmail" value='<?php echo isset($_POST["email"]) ? htmlspecialchars($_POST["email"]) : "" ?>'>
 
 	<br><br><br><br>
 	
 	<input type="submit" class="submit" name="submit" value="Next">
 	
 	<br><br><br><br>
 	
	 <label class="formLabel">Don't have an account?</label>
	 	
 	<br><br><br>
 	
 	<a href="../../signup">
 	
 		<button type="button" class="otherButton">Sign Up</button>
 		
 	</a>
 	
 	<br><br>
 
 </form>
 
</div>

<?php

	include("../../templates/footer.php");
	
?>
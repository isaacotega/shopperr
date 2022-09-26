<?php
	
	session_start();
	
	$page = array("title" => "Reset password", "rootPath" => "../");
	
	require_once("../scripts/php/connection.php");
	
	include_once("../scripts/php/functions.php");
	
	include_once("../scripts/php/methods.php");
	
	
	isset($_GET["id"]) or die(relocate("../"));
	
	$accessCode = $_GET["id"];
	
	$sql = "SELECT * FROM pending_password_resets WHERE access_code = '$accessCode' ";
	
	if($result = mysqli_query($conn, $sql)) {
	
		(mysqli_num_rows($result) !== 0) or die(("You have used an invalid reset link"));
	
		$row = mysqli_fetch_array($result);
		
		if($row["active"] == "false") {
		
			die("This reset link is expired");
		
		}
		
		else {
		
			$usercode = $row["recoverer_usercode"];
		
		}
		
	}
		
	
	if(isset($_POST["submit"])) {
		
		if(!empty($_POST["password"]) && !empty($_POST["reenteredPassword"])) {
			
			if($_POST["reenteredPassword"] !== $_POST["password"]) {
			
				toast("Password mismatch");
			
			}
			
			else {
	
				$password = $_POST["password"];
	
				$reenteredPassword = $_POST["reenteredPassword"];
				
				$sql = "UPDATE accounts SET password = '$password' WHERE usercode = '$usercode' ";
			
				if(mysqli_query($conn, $sql)) {
					
					$sql = "DELETE FROM pending_password_resets WHERE recoverer_usercode = '$usercode' ";
			
					mysqli_query($conn, $sql);
					
					toast("Password reset successful");
					
					relocate("../login");
			
				}
			
			}
			
		}
		
		else {
		
			toast("Please fill in the details");
		
		}
	
	}
	
	include_once("../templates/header.php");
	
?>

<link rel="stylesheet" type="text/css" href="../styles/account-page.css">

<script src="../scripts/js/account-page.js"></script>

<div id="main">

  <form method="post" class="form" autocomplete="off">
 
 	<br><br>
 
 	<label class="formHeading">Reset password (<?php echo accountDetails($usercode)["emailAddress"]; ?>)</label>
 	
 	<br>
 	
	 <div class="formError">
	 
	 	<label></label>
	 
	 </div>
 	
 	<br><br><br><br><br>
 
 	<input type="password" name="password" placeholder="New password" class="input" id="inpPassword" value='<?php echo isset($_POST["password"]) ? htmlspecialchars($_POST["password"]) : "" ?>'>
 
 	<br><br>
 	
 	<input type="password" name="reenteredPassword" placeholder="Re-enter password" class="input" id="inpConfirmPassword" value='<?php echo isset($_POST["reenteredPassword"]) ? htmlspecialchars($_POST["reenteredPassword"]) : "" ?>'>
 	
 	<br><br><br><br><br>
 	
 	<br><br>
 	
 	<input type="submit" name="submit" class="submit" value="Reset password">
 	
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
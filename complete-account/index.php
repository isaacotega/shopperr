<?php
	
	session_start();
	
	include("../scripts/php/functions.php");
	
	require("../scripts/php/connection.php");
	
	isset($_SESSION["uncompletedAccount"]) or die(relocate("../"));
	
	$usercode = $_SESSION["uncompletedAccount"]["usercode"];
	
	$sql = "SELECT * FROM accounts WHERE usercode = '$usercode' ";
	
	if($result = mysqli_query($conn, $sql)) {
					
		$row = mysqli_fetch_array($result);
		
		$email = $row["email_address"];
		
		$cookieCode = $row["cookie_code"];
	
	}
		
	
	$page = array("title" => "Complete account", "rootPath" => "../");
	
	include("../templates/header.php");
	
	
	if(isset($_POST["submit"])) {
	
		if(!empty($_POST["username"]) && !empty($_POST["password"])) {
			
			if($_POST["reenteredPassword"] !== $_POST["password"]) {
			
				toast("Password mismatch");
			
			}
			
			else {
	
				$username = $_POST["username"];
	
				$password = $_POST["password"];
				
				$sql = "UPDATE accounts SET username = '$username', password = '$password' WHERE usercode = '$usercode' ";
			
				if(mysqli_query($conn, $sql)) {
					
					$_SESSION["uncompletedAccount"] = null;
					
					relocate("../scripts/php/ckstr.php?r=set-account-cookie&cookie-code=" . $cookieCode);
			
				}
			
			}
			
		}
		
		else {
		
			toast("Please fill in the details");
		
		}
	
	}
	
	
 ?>
 
 
<link rel="stylesheet" type="text/css" href="../styles/account-page.css">

<div id="main">

  <form method="post" class="form" id="frmLogin" autocomplete="off">
 
 	<br><br>
 
 	<label class="formHeading">Complete your account details, <?php echo $email; ?></label>
 	
 	<br><br><br><br>
 	
 	<input type="text" name="username" placeholder="Enter your username" class="input" id="inpUsername">
 
 	<br><br>
 	
 	<input type="password" name="password" placeholder="Create password" class="input" id="inpPassword">
 
 	<br><br>
 	
 	<input type="password" name="reenteredPassword" placeholder="Re-enter password" class="input" id="inpConfirmPassword">
 	
 	<br><br><br>
 
 	<input type="submit" class="submit" name="submit" value="Submit">
 	
 	<br><br><br><br>
 
 </form>
 
</div>

<?php

	include("../templates/footer.php");
	
?>
 
 
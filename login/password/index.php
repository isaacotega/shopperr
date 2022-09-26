<?php
	
	session_start();
	
	$page = array("title" => "Sign in", "rootPath" => "../../");
	
	include("../../templates/header.php");
	
	isset($_SESSION["loginDetails"]["email"]) or die(relocate("../email"));
	
	require("../../scripts/php/connection.php");
	
	
	if(isset($_POST["submit"])) {
	
		if(!empty($_POST["password"])) {
			
			$email = $_SESSION["loginDetails"]["email"];
	
			$password = $_POST["password"];
	
			$sql = "SELECT * FROM accounts WHERE email_address = '$email' AND password = '$password' ";
			
			if($result = mysqli_query($conn, $sql)) {
			
				if(mysqli_num_rows($result) == 0) {
				
					toast("Incorrect Password");
				
				}
				
				else {
				
					$row = mysqli_fetch_array($result);
					
					$_SESSION["loginDetails"] = null;
					
					$cookieCode = $row["cookie_code"];
					
					if(isset($_GET["next"])) {
						
					relocate("../../scripts/php/ckstr.php?r=set-account-cookie&cookie-code=" . $cookieCode . "&n=" . urlencode($_GET["next"]));
					
					}
						
					else {
					
					relocate("../../scripts/php/ckstr.php?r=set-account-cookie&cookie-code=" . $cookieCode);
					
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
 
 	<label class="formHeading">Enter password</label>
 	
 	<br><br><br><br>
 	
 	<input type="password" name="password" placeholder="Enter Password" class="input" id="inpPassword">
 
 	<br><br>
 	
 	<p id="forgottenPassword">
 		
 		<a href="../../recover/preview"><em>Forgotten password?</em></a>
 		
 	</p>
 	
 	<br>
 	
 	<input type="submit" class="submit" name="submit" value="Log In">
 	
 	<br><br><br><br>
 	
 </form>
 
</div>

<?php

	include("../../templates/footer.php");
	
?>
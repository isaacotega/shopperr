<style>
 
 	body {
 		height: 100%;
 		background-color: rgba(0, 0, 0, 0.1);
 	}
 	
 	.p {
 		font-size: 30px;
 		width: 100%;
 		text-align: center;
 		position: fixed;
 		top: 45%;
 		left: 0;
 		transform: translateY(-50%);
 		color: white;
 	}
 	
 	#errorMessage {
 		color: white;
 	}
 
 	#successMessage {
 		color: white;
 	}
 
 </style>
 
 <?php
	
	$page = array("title" => "Email confirmed successfully", "rootPath" => "../");
	
	include("../scripts/php/general-info.php");
	
	include("../scripts/php/functions.php");
	
	require("../scripts/php/connection.php");
	
	include("../templates/header.php");
	
	isset($_GET["id"]) or die(displayError());
	
	$code = $_GET["id"];
	
	$sql = "SELECT * FROM emails_pending_confirmation WHERE confirmation_code = '$code' ";
	
	if($result = mysqli_query($conn, $sql)) {
	
		(mysqli_num_rows($result) !== 0) or die(displayError());
	
		$row = mysqli_fetch_array($result);
		
		$email = $row["email_address"];
		
		$date = date("Y m d");
		
		$time = date("h:i");
		
						
		$usercode = "";						
							
		$cookie_code = "";
						
		for($i = 0; $i < 20; $i++) {
							
			$usercode .= rand(0, 9);
						
			$cookie_code .= rand(0, 9);
						
		}
						
		$sql = "INSERT INTO accounts (email_address, usercode, cookie_code, date_joined, time_joined) VALUES ('$email', '$usercode', '$cookie_code', '$date', '$time')";
		
		if(mysqli_query($conn, $sql)) {
			
			$sql = "DELETE FROM emails_pending_confirmation WHERE confirmation_code = '$code' ";
			
			if(mysqli_query($conn, $sql)) {
		
				echo('<p class="p" id="successMessage">You have successfully confirmed your email address, <b>' . $email . '</b>. Please log in to the ' . $app["appName"] . ' app with your email address to complete your account registration.</p>');
	
			}
		
		}
		
	}
	
	function displayError() {
	
		echo('<p class="p" id="errorMessage">There was an error carrying out this operation.</p>');
	
	}
	
 ?>
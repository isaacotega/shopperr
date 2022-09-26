<?php
	
	session_start();
	
	$page = array("title" => "Forgot password?", "rootPath" => "../../");
	
	require_once("../../scripts/php/connection.php");
	
	include_once("../../scripts/php/general-info.php");
	
	include_once("../../scripts/php/methods.php");
	
	include_once("../../scripts/php/functions.php");
	
	isset($_SESSION["loginDetails"]["email"]) or die(relocate("../../"));
	
	$email = $_SESSION["loginDetails"]["email"];
	
	$date = date("Y m d");
		
	$time = date("h:i");
	
	$mailNumber = 0;
	
	
	
	$sql = "SELECT * FROM pending_password_resets WHERE date_requested = '$date' ";
	
	if($result = mysqli_query($conn, $sql)) {
	
		while($row = mysqli_fetch_array($result)) {
		
			$accountSql = "SELECT * FROM accounts WHERE usercode = '" . $row["recoverer_usercode"] . "' ";
			
			if($accountResult = mysqli_query($conn, $accountSql)) {
	
				$accountRow = mysqli_fetch_array($accountResult);
				
				if($accountRow["usercode"] == $row["recoverer_usercode"]) {
				
					$mailNumber++;
				
				}
		
			}
			
		}
		
		$mailExceeded = ($mailNumber > 2);
				
	}
	
	include_once("../../templates/header.php");
	
 ?>
 
<link rel="stylesheet" type="text/css" href="../../styles/pages/recover.css">
 
<div id="main">
	
	<p class="statement">Forgotten password? Sorry about that.</p>
	
	<p class="statement">We can send you a password reset link to your email address, <?php echo $email; ?> to help you recover your account.</p>
	
	<?php
	
		if($mailExceeded == true) {
		
			echo '<p class="statement" style="color: red">You have exceeded the maximum number of password reset mails for today. Please try again another day.</p>';
		
		}
		
		else {
		
			echo '<div class="centerPlaced"> <a href="../../scripts/php/recover.php?request=initialize-mail-info"> <button id="btnSendLink">Send link</button> </a> </div>';
	
		}
	
	?>
	
	
	
</div>

<script>

	$("#btnSendLink").click(function() {
	
		fullLoader("Processing request . . .");
	
	});
	
</script>

<?php

	include("../../templates/footer.php");
	
?>
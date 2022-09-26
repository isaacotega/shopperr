<?php
	
	session_start();
	
	$page = array("title" => "Confirm email", "rootPath" => "../../");
	
	include("../../templates/header.php");
	
	isset($_SESSION["mailInfo"]) or die(relocate("../../"));
	
	$mailType = $_SESSION["mailInfo"]["mailType"];
	
	($mailType == "emailConfirmation") or die(relocate("../../"));
	
	$receiversMail = $_SESSION["mailInfo"]["emailAddress"];
	
?>

<div id="main">
	
	<p class="statement">We sent a mail to your email address, <b><?php echo $receiversMail; ?></b> to verify if it is yours. Please confirm your email by clicking on the link sent to your mail.</p>

	<p class="statement">If you don't find it, please check your spam folder as some email servers consider our mail as a spam.</p>

	<br><br>

	<?php
	
		if(isset($_GET["mail-exceeded"])) {
		
			echo '<p class="statement" style="color: red">You have exceeded the maximum number of confirmation mails for today. Please try again another day.</p>';
		
		}
		
		else {
		
			echo '<p class="statement">Didn\'t receive the mail?, <a href="../../scripts/php/mail-resender.php" id="ancResendEmail">resend mail</a></p>';
	
		}
	
	?>
	
</div>

<script>

	$("#ancResendEmail").click(function() {
	
		fullLoader("Resending mail . . .");
	
	});

</script>

<?php

	include("../../templates/footer.php");
	
?>
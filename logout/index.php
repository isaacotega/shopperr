<?php
	
	$page = array("title" => "Sign out", "rootPath" => "../", "unrestricted" => array("accountHolders") );
	
	include("../templates/header.php");
	
 ?>
 
<link rel="stylesheet" type="text/css" href="../styles/account-page.css">

<div id="main">
	
	<div id="logoutContainer">
	
		<p>Do you really want to sign out of your account, <b><?php echo $user["account"]["username"]; ?></b>?</p>
		
		<br><br>
		
		<a href="../scripts/php/ckstr.php?r=delete-account-cookie">
		
			<button id="btnSignOut">Sign out</button>
			
		</a>
	
	</div>
	
</div>

<script>

	$("#btnSignOut").click(function() {
	
		fullLoader("Signing out . . .");
	
	});
	
</script>

<?php

	include("../templates/footer.php");
	
?>
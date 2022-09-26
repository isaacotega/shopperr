<?php
	
	$page = array("title" => "", "rootPath" => "../../");
	
	include_once("../../scripts/php/general-info.php");
	
	include_once("../../scripts/php/account-info.php");
	
	include_once("../../scripts/php/functions.php");
	
	include_once("../../scripts/php/methods.php");
	
	$businessId = $_GET["id"];
	
	(businessDetails($businessId)["exists"] or die(relocate("../../")));
	
	$page["title"] = businessDetails($businessId)["name"];
	
	
	include_once("../../templates/header.php");
	
	require_once("../../scripts/php/connection.php");
	
	include_once("../../scripts/php/methods.php");
	
	include_once("../../templates/portals/business-profile-picture-uploader.php");
	
 ?>
 
 <link rel="stylesheet" type="text/css" href="../../styles/business-page.css">
 
<div id="main">
	
	<div id="activeBusinessContainer">
	
		<div id="profilePictureHolder">
		
			<img id="profilePicture" src="<?php echo businessDetails($businessId)["profilePictureSrc"]; ?>"></img>
			
		</div>
		
		<h1 id="businessName"><?php echo $user["account"]["activeBusiness"]["name"]; ?></h1>
		
		<br><br>
		
		<div id="invitationHolder">
			
			<p></p>
		
		</div>
		
	</div>
	
</div>

<script>

	$("#profilePictureHolder #icnEdit").click(function() {
	
		$("#businessProfilePictureUploaderPortal").css("display", "block");
	
	});

</script>

<?php

	include("../../templates/footer.php");
	
?>
<?php
	
	$page = array("title" => "Active business ()", "rootPath" => "../../", "unrestricted" => array("accountHolders") );
	
	include_once("../../scripts/php/general-info.php");
	
	include_once("../../scripts/php/account-info.php");
	
	include_once("../../scripts/php/functions.php");
	
	($user["account"]["isBusinessActive"]) or die(relocate("../"));
	
	$page["title"] = "Active business (" . $user["account"]["activeBusiness"]["name"] . ")";
	
	
	include_once("../../templates/header.php");
	
	require_once("../../scripts/php/connection.php");
	
	include_once("../../scripts/php/methods.php");
	
	include_once("../../templates/portals/business-profile-picture-uploader.php");
	
 ?>
 
 <link rel="stylesheet" type="text/css" href="../../styles/business-page.css">
 
<div id="main">
	
	<div id="activeBusinessContainer">
	
		<div id="profilePictureHolder">
		
			<img id="profilePicture" src="<?php echo $user["account"]["activeBusiness"]["profilePictureSrc"]; ?>"></img>
			
			<span id="icnEdit"><?php echo icon("edit", "svg"); ?></span>
		
		</div>
		
		<h1 id="businessName"><?php echo $user["account"]["activeBusiness"]["name"]; ?></h1>
		
		<br><br>
		
		<div class="optionHolder">
		
		<?php
			
			$option = array("text" => "Admins (" . $user["account"]["activeBusiness"]["adminNo"] . ")", "anchored" => true, "href" => "admins", "clickEvent" => "fullLoader()");
			
			include("../../templates/option.php");
			
			$option = array("text" => "Settings", "anchored" => true, "href" => "settings", "clickEvent" => "fullLoader()");
			
			//include("../../templates/option.php");
			
			$option = array("text" => "Log out", "anchored" => true, "href" => "../../scripts/php/business.php?request=logout", "clickEvent" => "fullLoader()");
			
			include("../../templates/option.php");
			
			$option = array("text" => "Switch active business", "anchored" => true, "href" => "../", "clickEvent" => "fullLoader()");
			
			include("../../templates/option.php");
			
		?>
		
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
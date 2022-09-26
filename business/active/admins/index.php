<?php
	
	$page = array("title" => "Active business ()", "rootPath" => "../../../", "unrestricted" => array("accountHolders"), "headIcons" => array("add") );
	
	include_once("../../../scripts/php/general-info.php");
	
	include_once("../../../scripts/php/account-info.php");
	
	include_once("../../../scripts/php/functions.php");
	
	($user["account"]["isBusinessActive"]) or die(relocate("../../"));
	
	$page["title"] = $user["account"]["activeBusiness"]["name"] . " - Admins";
	
	include_once("../../../templates/header.php");
	
	require_once("../../../scripts/php/connection.php");
	
	include_once("../../../scripts/php/methods.php");
	
	include_once("../../../templates/portals/admin-inviter.php");
	
 ?>
 
 <link rel="stylesheet" type="text/css" href="../../../styles/business-page.css">
 
<div id="main">
	
	<div id="activeBusinessAdminsContainer">
		
		<div class="optionHolder">
		
		<?php
			
			$option = array("text" => $user["account"]["activeBusiness"]["adminNo"] . " admin" . (($user["account"]["activeBusiness"]["adminNo"] > 1) ? "s" : ""), "clickable" => false );
			
			include("../../../templates/option.php");
			
			foreach($user["account"]["activeBusiness"]["adminsUsercodes"] as $eachUsercode) {
				
				$option = array("text" => accountDetails($eachUsercode)["username"], "clickEvent" => "");
			
				include("../../../templates/option.php");
			
			}
			
			echo "<br><br>";
			
			$option = array("text" => "Invited", "clickable" => false );
			
			include("../../../templates/option.php");
			
			echo '<div id="invitedAdminsContainer">';
			
			if(count($user["account"]["activeBusiness"]["invitedAdminsEmailAddresses"]) == 0) {
			
				placeholder("#invitedAdminsContainer", "No invited admin!");
			
			}
			
			foreach($user["account"]["activeBusiness"]["invitedAdminsEmailAddresses"] as $eachEmailAddress) {
				
				if(emailInformation($eachEmailAddress)["isRegistered"]) {
				
					$option = array("text" => $eachEmailAddress . " (" . emailInformation($eachEmailAddress)["account"]["username"] . ")", "clickEvent" => "");
					
				}
			
				else {
				
					$option = array("text" => $eachEmailAddress, "clickEvent" => "");
				
				}
			
				include("../../../templates/option.php");
			
			}
			
			echo "</div>";
			
		?>
		
		</div>
		
	</div>
	
</div>

<script>

	$("#headIcon-add").click(function() {
	
		$("#adminInviterPortal").css("display", "block");
	
	});

</script>

<?php

	include("../../../templates/footer.php");
	
?>
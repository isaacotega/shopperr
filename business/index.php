<?php
	
	$page = array("title" => "Business", "rootPath" => "../", "unrestricted" => array("accountHolders"), "headIcons" => array("add"), "topNav" => array("exists" => true, "items" => array("Administered" => "?sort=administered")) );
	
	
	include_once("../scripts/php/general-info.php");
	
	include_once("../scripts/php/account-info.php");
	
	if(count($user["account"]["invitedBusinessesId"]) == 0) {
				
		$page["topNav"]["items"]["Invited"] = "?sort=invited";
		
	}
	
	else {
	
		$page["topNav"]["items"]["Invited (" . count($user["account"]["invitedBusinessesId"]) . ")"] = "?sort=invited";
		
	}
	
	
	include_once("../scripts/php/functions.php");
	
	isset($_GET["sort"]) or die(relocate("?sort=administered"));
	
	$sort = $_GET["sort"];
	
	switch($sort) {
	
		case "administered" :
		
			$page["topNav"]["selectedItem"] = "administered";
			
			break;
	
		case "invited" :
		
			$page["topNav"]["selectedItem"] = "invited";
			
			break;
		
		default :
		
			$page["topNav"]["selectedItem"] = "administered";
	
	}
	
	include_once("../templates/header.php");
	
	require_once("../scripts/php/connection.php");
	
	include_once("../scripts/php/methods.php");
	
 ?>
 
 <link rel="stylesheet" type="text/css" href="../styles/business-page.css">
 
<br><br><br><br><br><br>
 
<div id="main">
	
	<div id="container">
		
		<div class="optionHolder">
		
		<?php
		
			if($sort == "administered") {
			
			echo '<div id="administered">';
		
			if(count($user["account"]["administeredBusinessesId"]) == 0) {
				
				placeholder("#main #container #administered", "No business found!");
				
			}
				
			else {
				 
				foreach($user["account"]["administeredBusinessesId"] as $eachBusinessId) {
			
					$option = array("text" => businessDetails($eachBusinessId)["name"], "anchored" => true, "href" => "../scripts/php/business.php?request=switch-active-business&id=" . businessDetails($eachBusinessId)["id"], "clickEvent" => "fullLoader('Switching active business . . .')");
			
					include("../templates/option.php");
				
				}
			
			}
			
			echo "</div";
			
			}
			
			else if($sort == "invited") {
			
			echo '<div id="invited">';
		
			if(count($user["account"]["invitedBusinessesId"]) == 0) {
				
				placeholder("#main #container #invited", "No business invites!");
				
			}
				
			else {
				 
				foreach($user["account"]["invitedBusinessesId"] as $eachBusinessId) {
			
					$option = array("text" => businessDetails($eachBusinessId)["name"], "anchored" => true, "href" => "../scripts/php/business.php?request=accept-business-admin-invitation&id=" . $eachBusinessId, "clickEvent" => "fullLoader('Proceeding to business . . .')");
			
					include("../templates/option.php");
				
				}
			
			}
			
			echo "</div";
			
			}
			
			else {}
			
		?>
		
		</div>
		
	</div>
	
</div>

<script>

	$("#headIcon-add").click(function() {
		
		fullLoader();
	
		window.location.href = "new";
	
	});
	
	$("#container .businessOption").click(function() {
	
		fullLoader("Switching active business . . .");
	
	});

</script>

<?php

	include("../templates/footer.php");
	
?>
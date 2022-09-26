<?php
	
	$page = array("title" => "Market lists", "rootPath" => "../../", "headIcons" => array("add"), "unrestricted" => array("accountHolders", "businessActive"), "topNav" => array("exists" => true, "items" => array("Active" => "?type=active", "Uncleared" => "?type=uncleared", "Cleared" => "?type=cleared")) );
	
	include_once("../../scripts/php/functions.php");
	
	isset($_GET["type"]) or die(relocate("?type=active"));
	
	$listType = $_GET["type"];
	
	switch($listType) {
	
		case "active" :
		
			$page["topNav"]["selectedItem"] = "active";
			
			break;
	
		case "cleared" :
		
			$page["topNav"]["selectedItem"] = "cleared";
			
			break;
	
		case "uncleared" :
		
			$page["topNav"]["selectedItem"] = "uncleared";
			
			break;
		
		default :
		
			$page["topNav"]["selectedItem"] = "active";
	
	} 
	
	include_once("../../templates/header.php");
	
	include_once("../../scripts/php/methods.php");
	
?>

<br><br><br><br><br><br>
 
<div id="main">
	
	<div id="container">
	
		<div class="optionHolder">
		
		<?php
		
			switch($listType) {
	
				case "active" :
					
					foreach($user["account"]["activeMarketLists"]["ids"] as $eachId) {
						
						$option = array("text" => marketListDetails($eachId)["title"], "anchored" => true, "href" => "../?id=" . $eachId, "clickEvent" => "fullLoader()");
			
						include("../../templates/option.php");
							
					}
					
					if(count($user["account"]["activeMarketLists"]["ids"]) == 0) {
					
						placeholder("#container .optionHolder", "No active lists!");
					
					}
		
					break;
	
				case "cleared" :
					
					foreach($user["account"]["activeBusiness"]["marketListsIds"] as $eachId) {
						
						if(marketListDetails($eachId)["is"]["cleared"]) {
					
							$option = array("text" => marketListDetails($eachId)["title"], "anchored" => true, "href" => "../?id=" . $eachId, "clickEvent" => "fullLoader()");
			
							include("../../templates/option.php");
							
						}
					
					}
		
					break;
	
				case "uncleared" :
		
					foreach($user["account"]["activeBusiness"]["marketListsIds"] as $eachId) {
						
						if(!marketListDetails($eachId)["is"]["cleared"]) {
					
							$option = array("text" => marketListDetails($eachId)["title"], "anchored" => true, "href" => "../?id=" . $eachId, "clickEvent" => "fullLoader()");
			
							include("../../templates/option.php");
							
						}
					
					}
		
					break;
		
				}
				
			?>
	
		</div>
		
		</div>
		
	</div>
	
</div>

<script>

	$("#headIcon-add").click(function() {
		
		fullLoader();
	
		window.location.href = "../new";
	
	});
	
</script>

<?php

	include("../../templates/footer.php");
	
?>
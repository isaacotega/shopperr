<?php
	
	$page = array("title" => "", "rootPath" => "../", "unrestricted" => array("accountHolders", "businessActive") );
	
	include_once("../scripts/php/functions.php");
	
	include_once("../scripts/php/methods.php");
	
	isset($_GET["id"]) or die(relocate("../"));
	
	$listId = $_GET["id"];
	
	$marketListDetails = marketListDetails($listId);
	
	$marketListDetails["user"]["isAuthorized"] or die(relocate("../"));
	
	
	
	if(!$marketListDetails["is"]["cleared"]) {
	
		if($marketListDetails["user"]["isActive"]) {
	
			$listType = "active";
			
		}
		
		else {
	
			$listType = "creation";
			
		}
			
	}
		
	else if($marketListDetails["is"]["cleared"]) {
	
		$listType = "cleared";
	
	}
	
	else {}
	
	
	if($listType == "creation") {
	
		$page["headIcons"] = array("menu", "add", "edit", "delete");
		
		$page["cornerDropDown"] = array("exists" => true, "items" => array("Activate" => "activate", "Delete List" => "deleteList", "Details" => "details"));
		
	}
	
	else if($listType == "active") {
	
		$page["headIcons"] = array("menu", "add", "edit", "delete");
		
		$page["cornerDropDown"] = array("exists" => true, "items" => array("Deactivate" => "deactivate", "Delete List" => "deleteList", "Done shopping" => "doneShopping", "Details" => "details"));
	
	}
	
	else if($listType == "cleared") {
	
		$page["headIcons"] = array("menu");
		
		$page["cornerDropDown"] = array("exists" => true, "items" => array("Details" => "details"));
	
	}
	
	else {}
	
	
	$page["title"] = $marketListDetails["title"];
	
	include_once("../templates/header.php");
	
	include_once("../templates/input-suggestions.html");
	
	include_once("../templates/portals/delete-list.php");
	
	include_once("../templates/portals/done-shopping.php");
	
	include_once("../templates/portals/market-list-details.php");
	
	
	$all = array();
	
	foreach($user["account"]["activeBusiness"]["goods"]["ids"] as $eachId) {
		
		$all["goods"]["names"][] = goodDetails($eachId)["name"];
			 
	}
		
	$all["stores"]["names"] = array();
			 
	foreach($marketListDetails["itemsIds"] as $eachId) {
		
		$all["stores"]["names"][] = marketListItemsDetails($eachId)["store"];
			 
	}
	
?>

<link rel="stylesheet" type="text/css" href="../styles/pages/market-list.css">

<div id="main">
	
	<?php
		
		if($listType == "creation") {
	
			echo '<script src="../scripts/js/pages/market-list/creation.js"></script>';

			include("tables/creation.php");
			
		}
		
		else if($listType == "active") {
	
			echo '<script src="../scripts/js/pages/market-list/active.js"></script>';

			include("tables/active.php");
			
		}
		
		else if($listType == "cleared") {
	
			echo '<script src="../scripts/js/pages/market-list/cleared.js"></script>';

			include("tables/cleared.php");
			
		}
		
		else {}
		
	?>
	
</div>

<script>
	
	var all = [];
	
	var list = [];
	
	var selectedItemId;

	all["goods"] = JSON.parse('<?php echo json_encode($all["goods"]["names"]); ?>');
	
	all["quantities"] = JSON.parse('<?php echo json_encode($user["account"]["activeBusiness"]["goods"]["quantities"]); ?>');
	
	all["stores"] = JSON.parse('<?php echo json_encode($all["stores"]["names"]); ?>');
	
	list["id"] = '<?php echo $listId; ?>';
	
	
	$("#headIcon-delete").click(function() {

		if(selectedItemId !== undefined) {
		
			window.location.href = "../scripts/php/market-list.php?request=delete-item&list-id=" + list["id"] + "&item-id=" + selectedItemId;
		
		}

		else {
		
			toast("Please select a row");
		
		}
	
	});
	
	cornerDropDown["functions"]["deleteList"] = function() {

		cornerDropDown.default.close();

		$("#deleteListPortal").css("display", "block");
		
	}
	
	cornerDropDown["functions"]["doneShopping"] = function() {
	
		cornerDropDown.default.close();

		$("#doneShoppingPortal").css("display", "block");
		
	}
	
	cornerDropDown["functions"]["details"] = function() {
	
		cornerDropDown.default.close();

		$("#marketListDetailsPortal").css("display", "block");
		
	}
	
</script>

<?php

	include("../templates/footer.php");
	
?>
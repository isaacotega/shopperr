<?php
	
	$page = array("title" => $credebtType, "rootPath" => "../", "unrestricted" => array("accountHolders", "businessActive"), "headIcons" => array("menu", "add", "edit", "delete", "strike"), "cornerDropDown" => array("exists" => true, "items" => array("Edit history" => "editHistory")) );
	
	include_once("../scripts/php/functions.php");
	
	include_once("../scripts/php/methods.php");
	
	include_once("../templates/header.php");
	
	include_once("../templates/input-suggestions.html");
	
	
	$credebt = array("variables" => array("type" => $credebtType), "details" => array() );
	
	
	foreach($user["account"]["activeBusiness"][strtolower($credebt["variables"]["type"])]["uniqueIds"] as $eachId) {
	
		$credebt["details"][] = credebtorsDetails($eachId);
	
	}
	
	$all = array();
	
	foreach($user["account"]["activeBusiness"]["goods"]["ids"] as $eachId) {
		
		$all["goods"]["names"][] = goodDetails($eachId)["name"];
			 
	}
		
	foreach($user["account"]["activeBusiness"]["customers"]["names"] as $eachName) {
		
		$all["customers"]["names"][] = $eachName;
			 
	}
		
?>

<link rel="stylesheet" type="text/css" href="../styles/pages/credebtors.css">

<script src="../scripts/js/pages/credebtors/main.js"></script>

<div id="main">
	
	<?php
	
		include_once("../templates/credebtors/date-holder.php");
	
		include_once("../templates/credebtors/table.php");
	
	?>
	
</div>

<script>
	
	var credebt = {
		variables: {
			type: "<?php echo $credebt["variables"]["type"]; ?>"
		},
		details: JSON.parse('<?php echo json_encode($credebt["details"]); ?>')
	}
//	alert(JSON.stringify(credebt["details"]));


	var all = {};
	
	all["goods"] = JSON.parse('<?php echo json_encode($all["goods"]["names"]); ?>');
	
	all["customers"] = JSON.parse('<?php echo json_encode($all["customers"]["names"]); ?>');
	
	var username = '<?php echo $user["account"]["username"]; ?>';
	
</script>

<?php

	include("../templates/footer.php");
	
?>
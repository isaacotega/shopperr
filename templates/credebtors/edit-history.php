<?php
	
	$page = array("title" => "Edit history", "rootPath" => "../../", "unrestricted" => array("accountHolders", "businessActive") );
	
	include_once("../../scripts/php/functions.php");
	
	include_once("../../scripts/php/methods.php");
	
	include("../../templates/header.php");
	
	isset($_GET["id"]) or die(relocate("../"));
	
	$recordId = $_GET["id"];
	
	
	$credebt = array("variables" => array("type" => $credebtType), "details" => array() );
	
	
	foreach($user["account"]["activeBusiness"][strtolower($credebt["variables"]["type"])]["uniqueIds"] as $eachId) {
	
		if(credebtorsDetails($eachId)["recordId"] == $recordId) {
		
			$credebt["details"][] = credebtorsDetails($eachId);
	
		}
	
	}
	
?>

<link rel="stylesheet" type="text/css" href="../../styles/pages/credebtors.css">

<script src="../../scripts/js/pages/credebtors/edit-history.js"></script>

<div id="main">
	
	<?php
	
		include_once("../../templates/credebtors/edit-history-table.php");
	
	?>
	
</div>

<?php

	include("../../templates/footer.php");
	
 ?>
<?php
	
	$page = array("title" => "Receipts", "rootPath" => "../", "unrestricted" => array("accountHolders"), "headIcons" => array("add", "print"));
	
	include_once("../scripts/php/general-info.php");
	
	include_once("../scripts/php/functions.php");
	
	include_once("../scripts/php/methods.php");
	
	
	if(isset($_GET["id"])) {
	
		$receiptId = $_GET["id"];
		
	}
	
	else {
	
		if($user["account"]["activeBusiness"]["receipts"]["exists"]) {
		
			relocate("?id=" . $user["account"]["activeBusiness"]["receipts"]["ids"][(count($user["account"]["activeBusiness"]["receipts"]["ids"]) - 1)]);
		
		}
		
	}
	
	$receiptsDetails = array();
	
	
	foreach($user["account"]["activeBusiness"]["receipts"]["ids"] as $eachId) {
	
		$receiptsDetails[] = receiptDetails($eachId);
	
	}
	
	//echo json_encode($receiptsDetails);
	
	include_once("../templates/header.php");
	
 ?>
 
<link rel="stylesheet" type="text/css" href="../styles/@@.css">
 
<script src="../scripts/js/pages/receipts/main.js"></script>

<br><br><br><br><br><br>
 
<div id="main">
	
	<div id="errorHolder"></div>

	<?php
	
		if($user["account"]["activeBusiness"]["receipts"]["exists"]) {
		
			include_once("../templates/receipts/book.php");
			
		}
		
		else {
		
			placeholder("#errorHolder", "No receipts found!");
		
		}
	
	?>
 
</div>

<script>
	
	var currentReceiptDetails = {
		receiptId: '<?php echo $receiptId; ?>'
	}
	
	var receiptsDetails = JSON.parse('<?php echo json_encode($receiptsDetails); ?>');

</script>

<?php

	include("../templates/footer.php");
	
?>
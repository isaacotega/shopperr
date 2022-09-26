<?php
	
	$page = array("title" => "Goods", "rootPath" => "../", "headIcons" => array("search", "add", "edit", "refresh"), "unrestricted" => array("accountHolders", "businessActive") );
	
	include_once("../templates/header.php");
	
	include_once("../scripts/php/connection.php");
	
	include_once("../templates/portals/goods-adder.php");
	
	include_once("../templates/portals/goods-editor.php");
	
	include_once("../templates/input-suggestions.html");
	
?>

<link rel="stylesheet" type="text/css" href="../styles/goods.css">

<script src="../scripts/js/pages/goods.js"></script>

<div id="main">
	
	<?php
		
		$searchHolder = array("placeholder" => "Search goods by name or tags");
		
		include("../templates/search-holder.php");
		
	?>
	
	<div id="container">
	
		<div id="info"></div>
	
		<?php
			
			$allGoods = array("tags" => array(), "quantities" => array());
			
			$businessId = $user["account"]["activeBusiness"]["id"];
			
			$sql = "SELECT * FROM goods WHERE business_id = '$businessId' ";
			
			if($result = mysqli_query($conn, $sql)) {
				
				if(mysqli_num_rows($result) == 0) {
				
					placeholder("#container #info", "No goods found!");
				
				}
				
				$good = array();
				
				while($row = mysqli_fetch_array($result)) {
					
					$good["id"] = $row["good_id"];
		
					$good["name"] = $row["name"];
		
					$pricesSql = "SELECT * FROM prices WHERE good_id = '" . $good["id"] . "' ";	
			
					if($pricesResult = mysqli_query($conn, $pricesSql)) {
						
						$good["quantityArray"] = array();
								
						$good["pricesArray"] = array();
						
						while($pricesRow = mysqli_fetch_array($pricesResult)) {
						
							$good["quantityArray"][] = $pricesRow["quantity"];
		
							$good["pricesArray"][] = $pricesRow["price"];
		
							$allGoods["quantities"][] = $pricesRow["quantity"];
						
						}
						
					}
					
					$tagsSql = "SELECT * FROM tags WHERE good_id = '" . $good["id"] . "' ";
			
					if($tagsResult = mysqli_query($conn, $tagsSql)) {
						
						$good["tags"] = array();
						
						while($tagsRow = mysqli_fetch_array($tagsResult)) {
						
							$good["tags"][] = $tagsRow["tag"];
							
							$allGoods["tags"][] = $tagsRow["tag"];
						
						}
						
					}
						
				//	else {echo mysqli_error($conn);}
					
					include("../templates/good-holder.php");
					
				}
				
			}
		
		?>
	
	</div>
	
</div>

<script>

	var allGoods = [];
	
	allGoods["tags"] = JSON.parse('<?php echo json_encode($allGoods["tags"]); ?>');

	allGoods["quantities"] = JSON.parse('<?php echo json_encode($allGoods["quantities"]); ?>');

</script>

<?php

	include("../templates/footer.php");
	
?>
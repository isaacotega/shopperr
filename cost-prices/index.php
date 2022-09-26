<?php
	
	$page = array("title" => "Cost Prices", "rootPath" => "../", "unrestricted" => array("accountHolders", "businessActive"), "headIcons" => array("menu", "search"), "cornerDropDown" => array("exists" => true, "items" => array("Source" => "source")) );
	
	include_once("../scripts/php/functions.php");
	
	include_once("../scripts/php/methods.php");
	
	
	
	include_once("../templates/header.php");
	
 ?>
 
<script src="../scripts/js/pages/cost-prices.js"></script>

<div id="main">
	
	<?php
		
		$searchHolder = array("placeholder" => "Search goods by name");
		
		include("../templates/search-holder.php");
		
	?>
	
	<div id="container">
		
		<div id="info"></div>
	
		<div class="optionHolder">
		
		<?php
		
			if(count($user["account"]["activeBusiness"]["costPrices"]) == 0) {
				
				placeholder("#main #container #optionHolder", "Empty!");
				
			}
				
			else {
				 
				foreach($user["account"]["activeBusiness"]["costPrices"] as $costPrice) {
			
					$option = array("id" => $costPrice["itemId"], "text" => marketListItemsDetails($costPrice["itemId"])["goodsName"], "littleText" => array("type" => "hidden", "text" => $app["currency"] . $costPrice["price"] . " / " . $costPrice["quantity"]), "clickEvent" => "");
			
					include("../templates/option.php");
				
				}
			
			}
			
		?>
		
		</div>
		
	</div>
	
</div>

<script>
	
</script>

<?php

	include("../templates/footer.php");
	
?>
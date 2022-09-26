<?php
	
	include_once($page["rootPath"] . "scripts/php/methods.php");

	function linkSvg($link) {
		
		global $page;
	
		echo file_get_contents($page["rootPath"] . "icons/" . $link . ".svg");
	
	}
	
?>

<div id="sideNav">
				
	<div id="container">
				
		<div id="head">
					
			<p id="name"> <?php echo $app["appName"]; ?> </p>
						
		</div>
					
		<div id="body">
					
			<a href="<?php echo $page["rootPath"]; ?>"> <label class="sideLinks"> <?php linkSvg("home"); ?> Home</label> </a>
					
			<a href="<?php echo $page["rootPath"]; ?>goods"> <label class="sideLinks"> <?php linkSvg("goods"); ?> Goods</label> </a>
					<!--
			<a href="<?php echo $page["rootPath"]; ?>receipts"> <label class="sideLinks"> <?php linkSvg("receipts"); ?> Receipts</label> </a>
					-->
			<a href="<?php echo $page["rootPath"]; ?>market-list/list"> <label class="sideLinks"> <?php linkSvg("market-list"); ?> Market List<?php echo (($user["account"]["hasActiveMarketList"]) ? " (" . marketListDetails($user["account"]["activeMarketLists"]["ids"][0])["title"] . ")" : ""); ?></label> </a>
					
			<a href="<?php echo $page["rootPath"]; ?>cost-prices"> <label class="sideLinks"> <?php linkSvg("market-list"); ?> Cost Prices</label> </a>
					
			<a href="<?php echo $page["rootPath"]; ?>creditors"> <label class="sideLinks"> <?php linkSvg("creditors"); ?> Creditors</label> </a>
					
			<a href="<?php echo $page["rootPath"]; ?>debtors"> <label class="sideLinks"> <?php linkSvg("debtors"); ?> Debtors</label> </a>
					
			<a href="<?php echo $page["rootPath"]; ?>business/active"> <label class="sideLinks"> <?php linkSvg("business"); ?> Business (<?php echo $user["account"]["activeBusiness"]["name"]; ?>)</label> </a>
					
			<a href="<?php echo $page["rootPath"]; ?>account"> <label class="sideLinks"> <?php linkSvg("account"); ?> Account (<?php echo $user["account"]["username"]; ?>)</label> </a>
					
			<a href="<?php echo $page["rootPath"]; ?>logout"> <label class="sideLinks"> <?php linkSvg("logout"); ?> Sign out</label> </a>
					
			<a href="<?php echo $page["rootPath"]; ?>feedback"> <label class="sideLinks"> <?php linkSvg("feedback"); ?> Feedback</label> </a>
					
			<a href="<?php echo $page["rootPath"]; ?>donate"> <label class="sideLinks"> <?php linkSvg("donate"); ?> Donate</label> </a>
					
			<label class="sideLinks" id="sdLnkExit"> <?php linkSvg("exit"); ?> Exit</label>
					
		</div>
					
	</div>
			
</div>
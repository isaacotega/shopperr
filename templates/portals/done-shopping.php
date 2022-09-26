<link rel="stylesheet" type="text/css" href="<?php echo $page["rootPath"]; ?>styles/portals.css">
 
 <script>
 
 	var portalInfo = {
 		rootPath: '<?php echo $page["rootPath"]; ?>'
 	}
 
 </script>
 
 <script src="<?php echo $page["rootPath"]; ?>scripts/js/portals/done-shopping.js"></script>
 
 <div id="doneShoppingPortal" class="portal">
 	
 	<div id="head">
 	
 		<label id="heading">Done shopping?</label>
 		
 		<span class="topIcon" id="icnClose"> <?php echo file_get_contents($page["rootPath"] . "icons/close.svg"); ?> </span>
 	
 	</div>
 	
 	<div id="container">
 		
 		<br><br>
 		
 		<label class="label">If you're done shopping, click the 'Done' button below. Your market list, <?php echo $marketListDetails["title"]; ?> will then be found below the cleared nav and will no longer be editable.</label>
 		
 		<br><br>
 		
 		<a href="<?php echo $page["rootPath"]; ?>scripts/php/market-list.php?request=clear-list&list-id=<?php echo $listId; ?>">
 		
 			<button id="btnDone" class="submitButton">Done</button>
 		
 		</a>
 	
 		<br><br><br><br>
 	
 	</div>
 	
 </div>
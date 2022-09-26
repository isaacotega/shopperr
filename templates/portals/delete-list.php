<link rel="stylesheet" type="text/css" href="<?php echo $page["rootPath"]; ?>styles/portals.css">
 
 <script>
 
 	var portalInfo = {
 		rootPath: '<?php echo $page["rootPath"]; ?>'
 	}
 
 </script>
 
 <script src="<?php echo $page["rootPath"]; ?>scripts/js/portals/delete-list.js"></script>
 
 <div id="deleteListPortal" class="portal">
 	
 	<div id="head">
 	
 		<label id="heading">Delete market list</label>
 		
 		<span class="topIcon" id="icnClose"> <?php echo file_get_contents($page["rootPath"] . "icons/close.svg"); ?> </span>
 	
 	</div>
 	
 	<div id="container">
 		
 		<br><br>
 		
 		<label class="label">Do you really want to permanently delete your market list, <?php echo $marketListDetails["title"]; ?>?</label>
 		
 		<br><br><br>
 		
 		<a href="<?php echo $page["rootPath"]; ?>scripts/php/market-list.php?request=delete-list&list-id=<?php echo $listId; ?>">
 		
 			<button id="btnDelete" class="submitButton">Delete</button>
 		
 		</a>
 	
 		<br><br><br><br>
 	
 	</div>
 	
 </div>
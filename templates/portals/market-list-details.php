<link rel="stylesheet" type="text/css" href="<?php echo $page["rootPath"]; ?>styles/portals.css">
 
<link rel="stylesheet" type="text/css" href="<?php echo $page["rootPath"]; ?>styles/portals/market-list-details.css">
 
 <script>
 
 	var portalInfo = {
 		rootPath: '<?php echo $page["rootPath"]; ?>'
 	}
 
 </script>
 
 <script src="<?php echo $page["rootPath"]; ?>scripts/js/portals/market-list-details.js"></script>
 
 <div id="marketListDetailsPortal" class="portal">
 	
 	<div id="head">
 	
 		<label id="heading">Details</label>
 		
 		<span class="topIcon" id="icnClose"> <?php echo file_get_contents($page["rootPath"] . "icons/close.svg"); ?> </span>
 	
 	</div>
 	
 	<div id="container">
 		
 		<br><br>
 		
 		<table id="tblDetails">
 		
 			<tbody>
 				
 				<tr>
 				
 					<td>Name</td>
 				
 					<td><?php echo $marketListDetails["title"]; ?></td>
 				
 				</tr>
 			
 				<tr>
 				
 					<td>Creator</td>
 				
 					<td><?php echo accountDetails($marketListDetails["creatorUsercode"])["username"]; ?></td>
 				
 				</tr>
 			
 				<tr>
 				
 					<td>Date created</td>
 				
 					<td><?php echo $marketListDetails["dateCreated"] . " | " . $marketListDetails["timeCreated"]; ?></td>
 				
 				</tr>
 			
 				<tr>
 				
 					<td>Sheduled date</td>
 				
 					<td><?php echo $marketListDetails["scheduledDate"] . " | " . $marketListDetails["scheduledTime"]; ?></td>
 				
 				</tr>
 			
 			</tbody>
 		
 		</table>
 		
 		<br><br><br><br>
 	
 	</div>
 	
 </div>
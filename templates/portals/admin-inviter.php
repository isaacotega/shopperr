<link rel="stylesheet" type="text/css" href="<?php echo $page["rootPath"]; ?>styles/portals.css">
 
<link rel="stylesheet" type="text/css" href="<?php echo $page["rootPath"]; ?>styles/portals/admin-inviter.css">
 
 <script>
 
 	var portalInfo = {
 		rootPath: '<?php echo $page["rootPath"]; ?>'
 	}
 
 </script>
 
 <script src="<?php echo $page["rootPath"]; ?>scripts/js/portals/admin-inviter.js"></script>
 
 <div id="adminInviterPortal" class="portal">
 	
 	<div id="head">
 	
 		<label id="heading">Add new admins</label>
 		
 		<span class="topIcon" id="icnClose"> <?php echo file_get_contents($page["rootPath"] . "icons/close.svg"); ?> </span>
 	
 	</div>
 	
 	<div id="container">
 		
 		<br><br>
 		
 		<label class="label">Invite new admins to join you in administrating your business,  <?php echo $user["account"]["activeBusiness"]["name"]; ?>.</label>
 		
 		<br><br>
 		
 		<form method="post" id="frmAdminInviter" action="<?php echo $page["rootPath"]; ?>scripts/php/admin-inviter.php" autocomplete="off">
 		
 			<input type="email" name="emailAddress" placeholder="Enter email address" class="input" id="inpEmailAddress">
 			
 			<br><br><br>
 			
 			<button type="submit" class="submitButton">Invite</button>
 		
 		</form>
 	
 		<br><br>
 	
 	</div>
 	
 </div>
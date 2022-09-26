<link rel="stylesheet" type="text/css" href="<?php echo $page["rootPath"]; ?>styles/portals.css">
 
<link rel="stylesheet" type="text/css" href="<?php echo $page["rootPath"]; ?>styles/portals/business-profile-picture-uploader.css">
 
 <script>
 
 	var portalInfo = {
 		rootPath: '<?php echo $page["rootPath"]; ?>'
 	}
 
 </script>
 
 <script src="<?php echo $page["rootPath"]; ?>scripts/js/portals/business-profile-picture-uploader.js"></script>
 
 <div id="businessProfilePictureUploaderPortal" class="portal">
 	
 	<div id="head">
 	
 		<label id="heading">Upload new profile picture</label>
 		
 		<span class="topIcon" id="icnClose"> <?php echo file_get_contents($page["rootPath"] . "icons/close.svg"); ?> </span>
 	
 	</div>
 	
 	<div id="container">
 		
 		<br><br><br>
 	
 		<label class="label">Upload a profile picture for <?php echo $user["account"]["activeBusiness"]["name"]; ?></label>
 
 		<br><br><br>
 		
 		<form method="post" enctype="multipart/form-data" action="<?php echo $page["rootPath"]; ?>scripts/php/image-uploader.php?type=business_profile_picture&return_page=<?php echo urlencode("http://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]); ?>" id="frmUploadPicture">
 		
 			<input type="file" name="picture" id="inpUploadPicture" class="hidden">
 		
 			<label for="inpUploadPicture" id="lblUploadPicture"></label>
 		
 			<br><br><br>
 		
 			<button type="submit" id="btnSubmit" class="submitButton">Upload</button>
 			
 		</form>
 		
 		<br><br><br>
 		
 	</div>
 	
 </div>
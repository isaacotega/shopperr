<?php
	
	$page = array("rootPath" => "../../", "unrestricted" => array("accountHolders") );
	
	include_once("functions.php");
	
	include_once("general-info.php");
	
	include_once("account-info.php");
	
	$returnPage = (isset($_GET["return_page"]) ? $_GET["return_page"] : "../../");
	
	$imageType = (isset($_GET["type"]) ? $_GET["type"] : "../../");
	
	isset($_FILES["picture"]) or die(relocate($returnPage));
	
	function goBack() {
		
		global $returnPage;
	
		relocate($returnPage);
	
	}
	
	$imageFileType = strtolower(pathinfo(basename($_FILES["picture"]["name"]) , PATHINFO_EXTENSION));
	
	$check = getimagesize($_FILES["picture"]["tmp_name"]);
		
	if($check == false)  {
		
		toast("Upload denied: Only actual image files are allowed");
		
		goBack();
		
	}
		
	if($imageFileType !== "jpg" && $imageFileType !== "jpeg" && $imageFileType !== "png") {
	
		toast("Upload denied: Image must be in either JPG, JPEG,  or PNG extensions");
		
		goBack();
	
	}
	
	$limitedImageSizeMB = 1;
		
	if($_FILES["picture"]["size"] > ((1024 * 1024) * $limitedImageSizeMB) ) {
	
		toast("Upload denied: Your image file size must be less than 1MB");
		
		goBack();
	
	}
	
	
	if($imageType == "business_profile_picture") {
	
		$imageDestination = $user["account"]["activeBusiness"]["originalProfilePictureSrc"];
		
	}
		
	if(move_uploaded_file($_FILES["picture"]["tmp_name"] , $imageDestination)) {
	
		toast($user["account"]["activeBusiness"]["name"] . "'s profile picture uploaded successfully");
		
		goBack();
	
	}
	
 ?>
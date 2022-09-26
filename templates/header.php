<?php
		
	include_once($page["rootPath"] . "scripts/php/general-info.php");
		
	include_once($page["rootPath"] . "scripts/php/account-info.php");
		
	include_once($page["rootPath"] . "scripts/php/access-restrictor.php");
		
	include_once($page["rootPath"] . "scripts/php/functions.php");
		
?>
	
<!DOCTYPE html PUBLIC -//W3C//DTD XHTML 1.0 Strict//EN http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd>

	<html lang="en">

	<head>
	
		<title><?php echo $app["appName"] . " - " . $page["title"]; ?></title>
		
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	
		<meta name="viewport" content="user-scalable=no">
	
		<meta name=”robots” content="noindex, nofollow">
		
		<link rel="stylesheet" href="<?php echo $page["rootPath"]; ?>styles/index.css" type="text/css">
	
		<script src="<?php echo $page["rootPath"]; ?>scripts/js/JQuery.js"></script>
	
		<script src="<?php echo $page["rootPath"]; ?>scripts/js/templates.js"></script>
	
		<script src="<?php echo $page["rootPath"]; ?>scripts/js/main.js"></script>
	
	</head>
	
	<body>
		
	<?php
	
		include($page["rootPath"] . "templates/top-bar.php");
		
		if(!$user["isSignedIn"]) {
			
			include($page["rootPath"] . "templates/side-nav/unregistered.php");
			
		}
		
		else if($user["account"]["isBusinessActive"]) {
			
			include($page["rootPath"] . "templates/side-nav/business-active.php");
			
		}
		
		else if(!$user["account"]["isBusinessActive"]) {
			
			include($page["rootPath"] . "templates/side-nav/business-inactive.php");
			
		}
		
		else {}
		
		if(isset($page["topNav"])) {
		
			if($page["topNav"]["exists"]) {
		
				include($page["rootPath"] . "templates/top-nav.php");
				
			}
			
		}
		
		if(isset($page["cornerDropDown"])) {
		
			if($page["cornerDropDown"]["exists"]) {
				
				include($page["rootPath"] . "templates/corner-drop-down.php");
				
			}
			
		}
		
	?>
	
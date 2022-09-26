<?php
	 		
	header("Content-type: application/apk");
	
	header('Content-Disposition: attachment; filename="shopperr-v1.0.apk"');
	 	
	readfile("shopperr-v1.0.apk");
	
	exit;
	 	
?>
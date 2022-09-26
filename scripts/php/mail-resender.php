<?php
	
	session_start();
	
	include("functions.php");
	
	$_SESSION["mailInfo"]["mailOk"] = true;
	
	relocate("mailer.php");
	
 ?>
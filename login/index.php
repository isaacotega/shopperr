<?php

	include("../scripts/php/functions.php");
	
	if(isset($_GET["next"])) {
	
		relocate("email?next=" . urlencode($_GET["next"]));
	
	}
	
	else {
	
		relocate("email");
		
	}
	
?>
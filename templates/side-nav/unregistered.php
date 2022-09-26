<?php

	function linkSvg($link) {
		
		global $page;
	
		echo file_get_contents($page["rootPath"] . "icons/" . $link . ".svg");
	
	}
	
?>

<div id="sideNav">
				
	<div id="container">
				
		<div id="head">
					
			<p id="name"> <?php echo $app["appName"]; ?> </p>
						
		</div>
					
		<div id="body">
					
			<a href="<?php echo $page["rootPath"]; ?>"> <label class="sideLinks"> <?php linkSvg("home"); ?> Home</label> </a>
					
			<a href="<?php echo $page["rootPath"]; ?>login"> <label class="sideLinks"> <?php linkSvg("login"); ?> Sign in</label> </a>
					
			<label class="sideLinks" id="sdLnkExit"> <?php linkSvg("exit"); ?> Exit</label>
					
		</div>
					
	</div>
			
</div>
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
					
			<a href="<?php echo $page["rootPath"]; ?>business"> <label class="sideLinks"> <?php linkSvg("business"); ?> Business </label> </a>
					
			<a href="<?php echo $page["rootPath"]; ?>account"> <label class="sideLinks"> <?php linkSvg("account"); ?> Account (<?php echo $user["account"]["username"]; ?>)</label> </a>
					
			<a href="<?php echo $page["rootPath"]; ?>logout"> <label class="sideLinks"> <?php linkSvg("logout"); ?> Sign out</label> </a>
					
			<a href="<?php echo $page["rootPath"]; ?>feedback"> <label class="sideLinks"> <?php linkSvg("feedback"); ?> Feedback</label> </a>
					
			<a href="<?php echo $page["rootPath"]; ?>donate"> <label class="sideLinks"> <?php linkSvg("donate"); ?> Donate</label> </a>
					
			<label class="sideLinks" id="sdLnkExit"> <?php linkSvg("exit"); ?> Exit</label>
					
		</div>
					
	</div>
			
</div>
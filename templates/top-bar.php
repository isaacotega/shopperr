<div id="topBar">

	 <span id="navIcon">&#9776;</span>

	<label id="heading"><?php echo $page["title"]; ?></label>
	  		
	<?php
	  		
	  	if(isset($page["headIcons"])) {
	  			
	  		foreach($page["headIcons"] as $eachIcon) {
	  				
	  			echo '<span class="topIcon" id="headIcon-' . $eachIcon . '">' . file_get_contents($page["rootPath"] . "icons/" . $eachIcon . ".svg") . '</span>';
	  				
	  		}
	  	
	  		echo "";
	  			
	  	}
	  		
	?>
	  	
</div>
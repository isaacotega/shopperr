<div id="cornerDropDown">

	<div id="background"></div>

	<div id="container">
	
		<?php
		
			foreach($page["cornerDropDown"]["items"] as $option => $function) {
			
				echo '<span class="option" onclick="cornerDropDown.functions.' . $function . '()">' . $option . '</span>';
			
			}
		
		?>
	
	</div>

</div>

<script src="<?php echo $page["rootPath"]; ?>scripts/js/corner-drop-down.js"></script>
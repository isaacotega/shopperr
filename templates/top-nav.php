<script src="<?php echo $page["rootPath"]; ?>scripts/js/top-nav.js"></script>

<div id="topNav">

	<div id="container">
		
		<?php
		
			foreach($page["topNav"]["items"] as $text => $link) {
			
				echo '
					
					<a href="' . $link . '">
		
						<span class="item" id="' . ((strtolower($page["topNav"]["selectedItem"]) == strtolower($text)) ? "selected" : "") . '">' . $text . '</span>
			
					</a>
					
				';
			
			}
		
		?>
	
	</div>

</div>
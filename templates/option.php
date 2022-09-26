<?php

	if(isset($option["anchored"])) {
	
		if($option["anchored"]) {
	
			echo '<a href="' . $option["href"] . '">';
	
		}
		
	}
	
	if(isset($option["clickable"])) {
	
		if($option["clickable"]) {
	
			$option["class"] = "option";
			
		}
		
		else {
		
			$option["class"] = "unclickableOption";
		
		}
		
	}
	
	else {
	
		$option["class"] = "option";
			
	}

?>

<div onclick='$(".optionHolder .option").children("#littleText-hidden").css("display", "none"); $(this).children("#littleText-hidden").css("display", "block"); <?php echo isset($option["clickEvent"]) ? $option["clickEvent"] : ""; ?>' class="<?php echo $option["class"]; ?>" id="<?php echo isset($option["id"]) ? $option["id"] : ""; ?>">
	
	<label id="text"><?php echo $option["text"]; ?></label>
	
	<?php
	
		if(isset($option["littleText"])) {
		
			echo '<label id="littleText-' . $option["littleText"]["type"] . '">' . $option["littleText"]["text"] . '</label>';
			
		}
		
	?>
		
</div>

<?php

	if(isset($option["anchored"])) {
	
		if($option["anchored"]) {
	
			echo '</a>';
			
		}
	
	}

?>
	<div class="goodNameHolder" goodId="<?php echo $good["id"]; ?>">
	
		<label id="goodName"><?php echo $good["name"]; ?></label>
		
		<label id="goodTags"><?php foreach($good["tags"] as $tag) { echo $tag . " "; }; ?></label>
		
		<table id="tblDetails">
			
			<thead>
			
				<tr>
			
					<?php
					
						foreach($good["quantityArray"] as $quantity) {
						
							echo "<th>" . $quantity . "</th>";
						
						}
						
					?>
			
				</tr>
			
			</thead>
		
			<tbody>
			
				<tr>
			
					<?php
					
						foreach($good["pricesArray"] as $price) {
						
							echo "<td>" . $price . "</td>";
						
						}
						
					?>
						
				</tr>
			
			</tbody>
		
		</table>
	
	</div>
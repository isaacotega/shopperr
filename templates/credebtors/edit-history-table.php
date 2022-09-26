	<table class="table">

		<thead>
			
			<tr>
		
				<th>S/N</th>
			
				<th><?php echo $credebt["variables"]["type"]; ?>'s name</th>
			
				<th>Goods Bought</th>
			
				<th>Amount (<?php echo $app["currency"]; ?>)</th>
				
				<th>Notes</th>
				
				<th>Recorded by</th>
				
				<th>Date Recorded</th>
				
				<th>Time Recorded</th>
				
				<th>Date Edited</th>
				
				<th>Time Edited</th>
				
			</tr>
					
		</thead>
	
		<tbody>
			
			<?php
				
				$sn = 0;
			
				foreach($credebt["details"] as $credebtorsDetails) {
					
					$sn++;
					
					$shortNote = ((strlen($credebtorsDetails["notes"]) > 30) ? (substr($credebtorsDetails["notes"], 0, 30) . " . . .") : $credebtorsDetails["notes"]);
				
					echo '<tr> <td>' . $sn . '</td> <td>' . $credebtorsDetails["credebtorsName"] . '</td> <td>' . $credebtorsDetails["goodsBought"] . '</td> <td>' . $credebtorsDetails["amount"] . '</td> <td id="notes" fullNote="' . $credebtorsDetails["notes"] . '" shortNote="' . $shortNote . '" isDisplayingFullNote="false"></td> <td>' . $credebtorsDetails["recorderUsername"] . '</td> <td>' . $credebtorsDetails["dateAdded"] . '</td> <td>' . $credebtorsDetails["timeAdded"] . '</td> <td>' . $credebtorsDetails["dateOverwritten"] . '</td> <td>' . $credebtorsDetails["timeOverwritten"] . '</td> </tr>';
				
				}
			
			?>
			
		</tbody>
	
		<tfoot>
		
			<tr>
			
				<td></td>
			
				<td></td>
			
				<td></td>
			
				<td></td>
			
				<td></td>
			
				<td></td>
			
				<td></td>
			
				<td></td>
			
				<td></td>
			
				<td></td>
			
			</tr>
		
		</tfoot>
		
	</table>
	
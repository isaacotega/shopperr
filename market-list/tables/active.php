	<table class="table">

		<thead>
			
			<tr>
		
				<th>S/N</th>
			
				<th>Goods</th>
			
				<th>Quantity</th>
			
				<th>Budget (<?php echo $app["currency"]; ?>)</th>
				
				<th>Cost Price (<?php echo $app["currency"]; ?>)</th>
				
				<th>Store</th>
			
				<th>Notes</th>
			
			</tr>
					
		</thead>
	
		<tbody>
		
			<?php
				
				$i = 1;
				
				$totalBudget = 0;
		
				$totalCostPrice = 0;
		
				foreach($marketListDetails["itemsIds"] as $eachId) {
				
					$shortNote = ((strlen(marketListItemsDetails($eachId)["notes"]) > 30) ? substr(marketListItemsDetails($eachId)["notes"], 0, 30) . " . . ." : marketListItemsDetails($eachId)["notes"]);
					
					echo '<tr id="' . marketListItemsDetails($eachId)["itemId"] . '" class="itemRow"> <td id="sn">' . $i . '</td> <td id="goodsName">' . marketListItemsDetails($eachId)["goodsName"] . '</td> <td id="quantity">' . marketListItemsDetails($eachId)["quantity"] . '</td> <td id="budget">' . marketListItemsDetails($eachId)["budget"] . '</td> <td id="costPrice">' . marketListItemsDetails($eachId)["costPrice"] . '</td> <td id="store">' . marketListItemsDetails($eachId)["store"] . '</td> <td id="notes" fullNote="' . marketListItemsDetails($eachId)["notes"] . '" shortNote="' . $shortNote . '" isDisplayingFullNote=false></td> </tr>';
					
					$totalBudget += marketListItemsDetails($eachId)["budget"];
					
					$totalCostPrice += marketListItemsDetails($eachId)["costPrice"];
					
					$i++;
					
				}
		
			?>
		
			<form id="frmAddItem">
			
				<tr id="trAddItem">
				
					<td>
					
						<button type="submit" id="btnAddItem" class="submitButton">Add</button>
					
					</td>
				
					<td>
					
						<input type="text" id="inpGoodName" placeholder="Good Name">
					
					</td>
				
					<td>
					
						<input type="text" id="inpQuantity" placeholder="Quantity">
					
					</td>
				
					<td>
					
						<input type="number" id="inpBudget" placeholder="Budget">
					
					</td>
					
					<td>
					
						<input type="number" id="inpCostPrice" placeholder="Cost Price">
					
					</td>
				
					<td>
					
						<input type="text" id="inpStore" placeholder="Store">
					
					</td>
				
					<td>
					
						<input type="text" id="inpNotes" placeholder="Notes">
					
					</td>
					
				</tr>
				
			</form>
			
			<form id="frmEditItem">
			
				<tr id="trEditItem">
				
					<td>
					
						<button type="submit" id="btnEditItem" class="submitButton">Edit</button>
					
					</td>
				
					<td>
					
						<input type="text" id="inpGoodName" placeholder="Good Name">
					
					</td>
				
					<td>
					
						<input type="text" id="inpQuantity" placeholder="Quantity">
					
					</td>
				
					<td>
					
						<input type="number" id="inpBudget" placeholder="Budget">
					
					</td>
					
					<td>
					
						<input type="number" id="inpCostPrice" placeholder="Cost Price">
					
					</td>
				
					<td>
					
						<input type="text" id="inpStore" placeholder="Store">
					
					</td>
				
					<td>
					
						<input type="text" id="inpNotes" placeholder="Notes">
					
					</td>
					
				</tr>
				
			</form>
			
		</tbody>
	
		<tfoot>
		
			<tr>
			
				<td>Total</td>
			
				<td></td>
			
				<td></td>
			
				<td><?php echo $totalBudget; ?></td>
			
				<td><?php echo $totalCostPrice; ?></td>
			
				<td></td>
			
				<td></td>
			
			</tr>
		
		</tfoot>
		
	</table>
	
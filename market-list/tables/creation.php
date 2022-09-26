	<table class="table">

		<thead>
			
			<tr>
		
				<th>S/N</th>
			
				<th>Goods</th>
			
				<th>Quantity</th>
			
				<th>Budget (<?php echo $app["currency"]; ?>)</th>
				
			</tr>
					
		</thead>
	
		<tbody>
		
			<?php
				
				$i = 1;
				
				$totalBudget = 0;
		
				foreach($marketListDetails["itemsIds"] as $eachId) {
					
					echo '<tr id="' . marketListItemsDetails($eachId)["itemId"] . '" class="itemRow"> <td id="sn">' . $i . '</td> <td id="goodsName">' . marketListItemsDetails($eachId)["goodsName"] . '</td> <td id="quantity">' . marketListItemsDetails($eachId)["quantity"] . '</td> <td id="budget">' . marketListItemsDetails($eachId)["budget"] . '</td> </tr>';
					
					$totalBudget += marketListItemsDetails($eachId)["budget"];
					
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
					
				</tr>
				
			</form>
			
		</tbody>
	
		<tfoot>
		
			<tr>
			
				<td>Total</td>
			
				<td></td>
			
				<td></td>
			
				<td><?php echo $totalBudget; ?></td>
			
			</tr>
		
		</tfoot>
		
	</table>
	
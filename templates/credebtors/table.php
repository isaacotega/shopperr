	<table class="table">

		<thead>
			
			<tr>
		
				<th>S/N</th>
			
				<th><?php echo $credebt["variables"]["type"]; ?>'s name</th>
			
				<th>Goods Bought</th>
			
				<th>Amount (<?php echo $app["currency"]; ?>)</th>
				
				<th>Recorded by</th>
				
				<th>Time</th>
				
				<th>Notes</th>
				
			</tr>
					
		</thead>
	
		<tbody>
			
			<form id="frmAddItem">
			
				<tr id="trAddItem">
				
					<td>
					
						<button type="submit" id="btnAddItem" class="submitButton">Add</button>
					
					</td>
				
					<td>
					
						<input type="text" id="inpCredebtorsName" placeholder="<?php echo $credebt["variables"]["type"]; ?>'s Name">
					
					</td>
				
					<td>
					
						<input type="text" id="inpGoodsBought" placeholder="Goods Bought">
					
					</td>
				
					<td>
					
						<input type="number" id="inpAmount" placeholder="Amount">
					
					</td>
					
					<td id="tdUsername"></td>
			
					<td id="tdTime"></td>
			
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
					
						<input type="text" id="inpCredebtorsName" placeholder="<?php echo $credebt["variables"]["type"]; ?>'s Name">
					
					</td>
				
					<td>
					
						<input type="text" id="inpGoodsBought" placeholder="Goods Bought">
					
					</td>
				
					<td>
					
						<input type="number" id="inpAmount" placeholder="Amount">
					
					</td>
					
					<td id="tdUsername"></td>
			
					<td id="tdTime"></td>
			
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
			
				<td id="tdTotalAmount"></td>
			
				<td></td>
			
				<td></td>
			
				<td></td>
			
			</tr>
		
		</tfoot>
		
	</table>
	
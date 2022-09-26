<link rel="stylesheet" type="text/css" href="<?php echo $page["rootPath"]; ?>styles/templates/receipt-page.css">
 
 <div id="receiptPage">

	<div id="head">
	
		<h1 id="businessName"><?php echo $user["account"]["activeBusiness"]["name"]; ?></h1>
		
		<em id="motto">~~ <?php echo businessDetails($user["account"]["activeBusiness"]["id"])["motto"]; ?> ~~</em>
	
		<p id="address"><b>Address:</b> <?php echo businessDetails($user["account"]["activeBusiness"]["id"])["address"]; ?></p>
	
	</div>

	<div id="body">
	
		<table id="tblGoods">
		
			<thead>
			
				<tr>
				
					<th>S/N</th>
					
					<th>Goods</th>
					
					<th>Quantity</th>
					
					<th>Price(<?php echo $app["currency"]; ?>)</th>
					
				</tr>
				
			</thead>
		
			<tbody></tbody>
		
			<tfoot>
			
				<tr>
				
					<th>Total</th>
					
					<th></th>
					
					<th></th>
					
					<th></th>
					
				</tr>
				
			</tfoot>
		
		</table>
	
		<em id="refundPolicy">Goods purchased were delivered in good condition. No refund upon issuance of receipt</em>
	
	</div>

	<div id="foot">
	
		<em id="powerSource">Powered by <?php echo $app["appName"]; ?> <br> https://<?php echo $app["baseUrl"]; ?></em>
		
		<br><br>
		
		<div id="pageNumberHolder">
		
			<span id="pageNumber">a</span>
		
		</div>
	
	</div>

</div>
<link rel="stylesheet" type="text/css" href="<?php echo $page["rootPath"]; ?>styles/portals.css">
 
<link rel="stylesheet" type="text/css" href="<?php echo $page["rootPath"]; ?>styles/portals/goods-adder.css">
 
 <script>
 
 	var portalInfo = {
 		rootPath: '<?php echo $page["rootPath"]; ?>',
 		deleteIcon: '<?php echo file_get_contents($page["rootPath"] . "icons/delete.svg"); ?>'
 	}
 
 </script>
 
 <script src="<?php echo $page["rootPath"]; ?>scripts/js/portals/goods-editor.js"></script>
 
 <div id="goodsEditorPortal" class="portal">
 	
 	<div id="head">
 	
 		<label id="heading">Edit goods</label>
 		
 		<span class="topIcon" id="icnClose"> <?php echo file_get_contents($page["rootPath"] . "icons/close.svg"); ?> </span>
 	
 	</div>
 	
 	<div id="container">
 		
 		<br><br>
 	
 		<label class="label">Name</label>
 
 		<br>
 		
 		<input type="text" placeholder="Enter good's name" class="input" id="inpGoodsName">
 		
 		<br><br><br>
 		
 		<label class="label">Set prices</label>
 
 		<br>
 		
 		<table id="tblPricesList">
 		
 			<thead>
 				
 				<tr>
 			
 					<th>Quantity</th>
 			
 					<th>Price(<?php echo $app["currency"]; ?>)</th>
 					
 					<th></th>
 					
 				</tr>
 			
 			</thead>
 		
 			<tbody></tbody>
 		
 			<tfoot>
 				
 				<tr>
 			
 					<th>
 						
 						<input id="inpQuantity" type="text" placeholder="Quantity e.g. row">
					
					</th>
 			
 					<th>
 						
 						<input id="inpPrice" type="number" placeholder="Price(<?php echo $app["currency"]; ?>)">
					
					</th>
 					
 					<th></th>
 					
 				</tr>
 			
 			</tfoot>
 		
 		</table>
 		
 		<br>

                <button id="btnAddPrice">Set price</button>
                
 		<br><br><br><br>
 	
 		<label class="label">Tags</label>
 
 		<br>
 		
 		<div id="tagsHolder"></div>
 		
 		<form id="frmAddTag" autocomplete="off">
 		
 			<input type="text" placeholder="Enter tag name" class="input" id="inpTag">
 			
 		</form>
 		
 		<br><br><br><br>
 	
 		<button id="btnEditGood" class="submitButton">Edit good</button>
 	
 		<br><br><br><br>
 	
 	</div>
 	
 </div>
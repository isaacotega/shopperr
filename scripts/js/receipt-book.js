function fillReceipt(receiptId) {

	for(var i = 0; i < receiptsDetails.length; i++) {
		
		if(receiptsDetails[i]["receiptId"] == receiptId) {
		
			currentReceiptDetails = receiptsDetails[i];
				
			break;
			
		}
	
	}alert( JSON.stringify(currentReceiptDetails) );
		
	$("#receiptBook #receiptPage #pageNumber").attr("receiptId", currentReceiptDetails["receiptId"]);
		
	$("#receiptBook #receiptPage #pageNumber").html(currentReceiptDetails["pageNumber"]);
	
	for(var i = 0; i < currentReceiptDetails["goods"].length; i++) {
	
	
	
	}
		
}
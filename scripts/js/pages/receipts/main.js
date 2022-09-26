$(document).ready(function() {

	$("#headIcon-add").click(function() {
		
		fullLoader("Preparing receipt . . .");
	
		window.location.href = "../../scripts/php/receipts.php?request=new";
	
	});
	
	fillReceipt(currentReceiptDetails["receiptId"]);
	
});
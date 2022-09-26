$(document).ready(function() {
	
	$("#doneShoppingPortal #head #icnClose").click(function() {
	
		$("#doneShoppingPortal").css("display", "none");
	
	});
	
	$("#doneShoppingPortal #btnDone").click(function() {
	
		fullLoader();
	
	});
	
});
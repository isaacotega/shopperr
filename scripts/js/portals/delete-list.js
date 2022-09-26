$(document).ready(function() {
	
	$("#deleteListPortal #head #icnClose").click(function() {
	
		$("#deleteListPortal").css("display", "none");
	
	});
	
	$("#deleteListPortal #btnDelete").click(function() {
	
		fullLoader();
	
	});
	
});
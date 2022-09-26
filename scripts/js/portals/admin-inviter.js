$(document).ready(function() {
	
	$("#adminInviterPortal #head #icnClose").click(function() {
	
		$("#adminInviterPortal").css("display", "none");
	
	});
	
	$("#adminInviterPortal #frmAdminInviter").submit(function() {
	
		if($("#adminInviterPortal #inpEmailAddress").val() == "") {
			
			event.preventDefault();
		
			toast("Please enter an email address");
		
		}
	
	});
	
});
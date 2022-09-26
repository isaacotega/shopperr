$(document).ready(function() {
	
	$("#businessProfilePictureUploaderPortal #head #icnClose").click(function() {
	
		$("#businessProfilePictureUploaderPortal").css("display", "none");
	
	});
	
	var defaultFileInputText = "Choose file . . .";
	
	$("#businessProfilePictureUploaderPortal #inpUploadPicture + label").html(defaultFileInputText);
	
	
	$("#businessProfilePictureUploaderPortal #inpUploadPicture").change(function() {
	
		if(this.files.length !== 0) {
		
			$("#businessProfilePictureUploaderPortal #inpUploadPicture + label").html($(this).val().split("\\").pop());
			
		}
		
		else {
	
			$("#businessProfilePictureUploaderPortal #inpUploadPicture + label").html(defaultFileInputText);
		
		}
	
	});
	
	$("#businessProfilePictureUploaderPortal #frmUploadPicture").submit(function() {
	
		var fileInput = document.getElementById("inpUploadPicture");
	
		if(fileInput.files.length == 0) {
		
			event.preventDefault();
			
			toast("Please select a picture");
		
		}
		
		else {
		
			fullLoader("Uploading image . . .");
		
		}
	
	});
	
});
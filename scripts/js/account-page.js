$(document).ready(function() {

	$(".form").submit(function() {
	
		fullLoader("Processing . . .");
	
	});
	
	$(".form button").click(function() {
	
		fullLoader();
	
	});
	
});
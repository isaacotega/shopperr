$(document).ready(function() {
	
	for(var i = 0; i < $(".table tr").children("#notes").length; i++) {
	
		var currentCell = $(".table tr").children("#notes").eq(i);
	
		$(currentCell).html($(currentCell).attr("shortNote")).click(function() {
			
			if($(this).attr("isDisplayingFullNote") == "false") {
		
				$(this).html($(this).attr("fullNote"));
				
				$(this).attr("isDisplayingFullNote", "true");
				
			}
			
			else {
			
				$(this).html($(this).attr("shortNote"));
				
				$(this).attr("isDisplayingFullNote", "false");
				
			}
		
		});
	
	}
	
});
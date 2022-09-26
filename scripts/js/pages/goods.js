var selectedGood = {};

selectedGood["goodId"] = "none";

$(document).ready(function() {
	
	$("#headIcon-edit").click(function() {
	
		if(selectedGood["goodId"] == "none") {
		
			toast("Please select a good to edit");
		
		}
		
		else {
		
			fetchGoodsDetailsForEditing();
	
		}
	
	});

	$("#headIcon-add").click(function() {
	
		$("#goodsAdderPortal").css("display", "block");
	
	});

	$("#headIcon-refresh").click(function() {
		
		fullLoader("Refreshing . . .");
		
		window.location.reload();
		
	});
	
	var searchIsOut = false;
	
	$("#headIcon-search").click(function() {
		
		if(searchIsOut) {
		
			$(".searchHolder").css("display", "none");
		
			searchIsOut = false;
			
		}
		
		else {
	
			$(".searchHolder").css("display", "block");
		
			$(".searchHolder #inpSearch").focus();
			
			searchIsOut = true;
			
		}
	
	});
	
	$(".goodNameHolder").click(function() {
		
		selectedGood["goodId"] = $(this).attr("goodId");
		
		$(".goodNameHolder").children("#tblDetails").css("display", "none");
	
		$(this).children("#tblDetails").css("display", "block");
	
	});
	
	$(".searchHolder form").submit(function() {
	
		event.preventDefault();
	
		$(".searchHolder #inpSearch").blur();
	
	});
	
	$(".searchHolder #inpSearch").keyup(function() {
		
		var searchWord = $(this).val();
		
		var resultExists = false;
	
		for(var i = 0; i < $(".goodNameHolder").length; i++) {
			
			var currentElement = $(".goodNameHolder").eq(i);
		
			if( ($(currentElement).children("#goodTags").html().toLowerCase()).indexOf(searchWord.toLowerCase()) !== -1 || ($(currentElement).children("#goodName").html().toLowerCase()).indexOf(searchWord.toLowerCase()) !== -1 ) {
			
				$(currentElement).show();
				
				resultExists = true;
			
			}
			
			else {
			
				$(currentElement).hide();
			
			}
		
		}
		
		if(resultExists) {
		
			placeholder("#container #info", false);
		
		}
		
		else {
		
			placeholder("#container #info", "No match!");
		
		}
	
	});
	
});
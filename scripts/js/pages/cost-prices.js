$(document).ready(function() {
	
	var selectedItemId;
	
	$("#main #container .optionHolder .option").click(function() {
	
		selectedItemId = $(this).attr("id");
	
	});

	cornerDropDown["functions"]["source"] = function() {
	
		cornerDropDown.default.close();

		if(selectedItemId == undefined) {
		
			toast("Please select an item");
		
		}
		
		else {
		
			fullLoader();
			
			window.location.href = "rdr.php?destination=market-list&item-id=" + selectedItemId;
		
		}
		
	}
	
	
	$(".searchHolder").css("display", "none");
		
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
	
	$(".searchHolder form").submit(function() {
	
		event.preventDefault();
	
		$(".searchHolder #inpSearch").blur();
	
	});
	
	$(".searchHolder #inpSearch").keyup(function() {
		
		var searchWord = $(this).val();
		
		var resultExists = false;
		
		var itemOptions = $("#main #container .optionHolder .option");
	
		for(var i = 0; i < $(itemOptions).length; i++) {
			
			var currentElement = $(itemOptions).eq(i);
		
			if( ($(currentElement).children("#text").html().toLowerCase()).indexOf(searchWord.toLowerCase()) !== -1) {
			
				$(currentElement).show();
				
				resultExists = true;
			
			}
			
			else {
			
				$(currentElement).hide();
			
			}
		
		}
		
		if(resultExists) {
		
			placeholder("#main #container #info", false);
		
		}
		
		else {
		
			placeholder("#main #container #info", "No match!");
		
		}
	
	});
	
});
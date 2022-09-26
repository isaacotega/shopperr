$(document).ready(function() {
	
	$(".table #trAddItem").hide();
	
	$(".table #trEditItem").hide();
	
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
	
	$("#headIcon-add").click(function() {
		
		$(".table #trAddItem").show();
		
		$(".table #trAddItem #inpGoodName").focus();
	
	});
	
	$("#headIcon-edit").click(function() {
		
		if(selectedItemId !== undefined) {
		
			$(".table #trEditItem").show();
	
			var itemToEdit = {};
			
			itemToEdit["goodsName"] = $("#" + selectedItemId).children("#goodsName").html();
			
			itemToEdit["quantity"] = $("#" + selectedItemId).children("#quantity").html();
			
			itemToEdit["budget"] = $("#" + selectedItemId).children("#budget").html();
			
			itemToEdit["costPrice"] = $("#" + selectedItemId).children("#costPrice").html();
			
			itemToEdit["store"] = $("#" + selectedItemId).children("#store").html();
			
			itemToEdit["notes"] = $("#" + selectedItemId).children("#notes").html();
			
			$(".table #trEditItem #inpGoodName").val(itemToEdit["goodsName"]);
		
			$(".table #trEditItem #inpQuantity").val(itemToEdit["quantity"]);
		
			$(".table #trEditItem #inpBudget").val(itemToEdit["budget"]);
		
			$(".table #trEditItem #inpCostPrice").val(itemToEdit["costPrice"]);
		
			$(".table #trEditItem #inpStore").val(itemToEdit["store"]);
		
			$(".table #trEditItem #inpNotes").val(itemToEdit["notes"]);
		
			$(".table #trEditItem #inpGoodName").focus();
	
		}
		
		else {
		
			toast("Please select a row");
		
		}
	
	});
	
	$(".table tbody .itemRow").click(function() {
	
		selectedItemId = $(this).attr("id");
			
		$(".table tbody .itemRow").css("background-color", "blue");
		
		$(this).css("background-color", "darkblue");
	
	});
	
	$(".table #trAddItem #inpGoodName").keyup(function() {
		
		var suggestionsArray = [];
		
		for(var i = 0; i < all["goods"].length; i++) {
			
			if(all["goods"][i].toLowerCase().indexOf($(".table #trAddItem #inpGoodName").val().toLowerCase()) !== -1) {
		
				suggestionsArray.push(all["goods"][i]);
				
			}
		
		}
		
		showInputSuggestions(suggestionsArray, $(this).attr("id"));
	
	});
	
	$(".table #trEditItem #inpGoodName").keyup(function() {
		
		var suggestionsArray = [];
		
		for(var i = 0; i < all["goods"].length; i++) {
			
			if(all["goods"][i].toLowerCase().indexOf($(".table #trEditItem #inpGoodName").val().toLowerCase()) !== -1) {
		
				suggestionsArray.push(all["goods"][i]);
				
			}
		
		}
		
		showInputSuggestions(suggestionsArray, $(this).attr("id"));
	
	});
	
	$(".table #trAddItem #inpQuantity").keyup(function() {
		
		var suggestionsArray = [];
		
		for(var i = 0; i < all["quantities"].length; i++) {
			
			suggestionsArray.push($(this).val() + " " + all["quantities"][i]);
		
		}
		
		showInputSuggestions(suggestionsArray, $(this).attr("id"));
	
	});
	
	$(".table #trEditItem #inpQuantity").keyup(function() {
		
		var suggestionsArray = [];
		
		for(var i = 0; i < all["quantities"].length; i++) {
			
				suggestionsArray.push($(this).val() + " " + all["quantities"][i]);
		
		}
		
		showInputSuggestions(suggestionsArray, $(this).attr("id"));
	
	});
	
	$(".table #trEditItem #inpStore").keyup(function() {
		
		var suggestionsArray = [];
		
		for(var i = 0; i < all["stores"].length; i++) {
			
			if(all["stores"][i].toLowerCase().indexOf($(".table #trEditItem #inpStore").val().toLowerCase()) !== -1) {
		
				suggestionsArray.push(all["stores"][i]);
				
			}
		
		}
		
		showInputSuggestions(suggestionsArray, $(this).attr("id"));
	
	});
	
	$(".table #frmAddItem").submit(function() {
		
		event.preventDefault();
		
		if($(".table #trAddItem #inpGoodName").val() !== "") {
		
		$(".table #trAddItem").hide();
		
		var obj = {
			good: $(".table #trAddItem #inpGoodName").val(),
			quantity: $(".table #trAddItem #inpQuantity").val(),
			budget: $(".table #trAddItem #inpBudget").val(),
			costPrice: $(".table #trAddItem #inpCostPrice").val(),
			store: $(".table #trAddItem #inpStore").val(),
			notes: $(".table #trAddItem #inpNotes").val()
		}
		
		fullLoader();
		
		window.location.href = "../scripts/php/market-list.php?request=add-item&list-id=" + list["id"] + "&obj=" + JSON.stringify(obj);
		
		}
		
		else {
		
			toast("Please fill in the details");
		
			$(".table #trAddItem #inpGoodName").focus();
	
		}
	
	});
	
	$(".table #frmEditItem").submit(function() {
		
		event.preventDefault();
		
		if($(".table #trEditItem #inpGoodName").val() !== "") {
		
		$(".table #trEditItem").hide();
		
		var obj = {
			good: $(".table #trEditItem #inpGoodName").val(),
			quantity: $(".table #trEditItem #inpQuantity").val(),
			budget: $(".table #trEditItem #inpBudget").val(),
			costPrice: $(".table #trEditItem #inpCostPrice").val(),
			store: $(".table #trEditItem #inpStore").val(),
			notes: $(".table #trEditItem #inpNotes").val()
		}
		
		fullLoader();
		
		window.location.href = "../scripts/php/market-list.php?request=edit-item&list-id=" + list["id"] + "&item-id=" + selectedItemId + "&obj=" + JSON.stringify(obj);
		
		}
		
		else {
		
			toast("Please fill in the details");
		
			$(".table #trEditItem #inpGoodName").focus();
	
		}
	
	});
	
	cornerDropDown["functions"]["deactivate"] = function() {
		
		fullLoader("Deactivating . . .");

		window.location.href = "../scripts/php/market-list.php?request=deactivate-list&list-id=" + list["id"];

	}
	
});
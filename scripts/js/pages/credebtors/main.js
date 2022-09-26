$(document).ready(function() {
	
	$(".table #trAddItem").hide();
	
	$(".table #trEditItem").hide();
	
	
	var selectedRecordId;
	
	var date = new Date().toISOString().substr(0, 10).replace(/-/g, " ");
	
	
	setInterval(function() {
	
		var time = new Date().toISOString().substr(11, 5).split(":");
	
		$(".table [id=tdTime]").html( (Number(time[0]) + 1) + ":" + time[1]);
	
	}, 1000);
	

	$(".table [id=tdUsername]").html(username);
	
	
	fillTable();
	
	
	$("#dateHolder select").change(function() {
	
		fillTable();
	
	});
	
	 
	$("#dateHolder .navigators").click(function() {
		
		selectedRecordId = undefined;
		
		switch($(this).attr("id")) {
		
			case "frontNavigator" :
				
				var navigation = "front";
				
				break;
		
			case "backNavigator" :
				
				var navigation = "back";
				
				break;
		
		}
		
		var months = ["January", "Febuary", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
		
		var dropDownLists = {
			year:  $("#dateHolder #sltYear"),
			month: $("#dateHolder #sltMonth"),
			day:  $("#dateHolder #sltDay")
		}
		
		var derivedDate = months[Number($(dropDownLists["month"]).val()) - 1] + " " + $(dropDownLists["day"]).val() + ", " + $(dropDownLists["year"]).val();
		
		switch(navigation) {
			
			case "front" :
	
				var newDateArray = new Date( Date.parse(derivedDate) + (86500000 * 2) ).toISOString().substr(0, 10).split("-");
				
				break;
		
			case "back" :
	
				var newDateArray = new Date( Date.parse(derivedDate) - (86500000 / 2) ).toISOString().substr(0, 10).split("-");
				
				break;
		
		}
		
		$(dropDownLists["year"]).val(newDateArray[0]);
	
		$(dropDownLists["month"]).val(newDateArray[1]);
	
		$(dropDownLists["day"]).val(newDateArray[2]);
	
		fillTable();
	
	});
	
	function fillTable() {
	
		$(".table #trAddItem").hide();
	
		$(".table #trEditItem").hide();
	
		$(".table .row").remove();
	
		var requestedDate = $("#dateHolder #sltYear").val() + " " + $("#dateHolder #sltMonth").val() + " " + $("#dateHolder #sltDay").val();
	
		var tableBody = $(".table tbody");
		
		var sn = 0;
		
		var totalAmount = 0;
		
		for(var i = 0; i < credebt["details"].length; i++) {
		
		
			if(requestedDate == credebt["details"][i]["dateAdded"] && credebt["details"][i]["status"] !== "overwritten") {
			
				sn++;
				
				var fullNote = credebt["details"][i]["notes"];
			
				var shortNote = ((credebt["details"][i]["notes"].length > 30) ? credebt["details"][i]["notes"].substr(0, 30) + " . . ." : credebt["details"][i]["notes"]);
			
				var newRow = '<tr class="row" id="' + credebt["details"][i]["recordId"] + '" striked="' + credebt["details"][i]["striked"] + '"> <td id="sn">' + sn + '</td> <td id="credebtorsName">' + credebt["details"][i]["credebtorsName"] + '</td> <td id="goodsBought">' + credebt["details"][i]["goodsBought"] + '</td> <td id="amount">' + credebt["details"][i]["amount"] + '</td> <td id="amount">' + credebt["details"][i]["recorderUsername"] + '</td> <td id="timeAdded">' + credebt["details"][i]["timeAdded"] + '</td> <td id="notes" shortNote="' + shortNote + '" fullNote="' + fullNote + '" isDisplayingFullNote="false"></td> </tr>';
		
				$(tableBody).append(newRow);
				
				totalAmount += Number(credebt["details"][i]["amount"]);
				
			}
			
			$(".table #tdTotalAmount").html(totalAmount);
		
		}
		
		for(var i = 0; i < $(".table tr").length; i++) {
	
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
	
			if($(".table tr").eq(i).attr("striked") == "true") {
		
				$(".table tr").eq(i).css({
					textDecoration: "line-through",
					opacity: "0.8"
				});
				
			}
			
		}
		
		$(".table tbody .row").click(function() {
	
			selectedRecordId = $(this).attr("id");
			
			$(".table tbody .row").css("background-color", "blue");
		
			$(this).css("background-color", "darkblue");
	
		});
		
	}
	
	

	
	$("#headIcon-add").click(function() {
		
		$(".table #trAddItem").show();
		
		$(".table #trAddItem #inpCredebtorsName").focus();
	
	});
	
	$("#headIcon-edit").click(function() {
		
		if(selectedRecordId !== undefined) {
			
			for(var i = 0; i < credebt["details"].length; i++) {
			
				if(credebt["details"][i]["recordId"] == selectedRecordId) {
				
					if(credebt["details"][i]["striked"] == "true") {
					
						toast("Can't edit a striked record");
					
					}
					
					else {
					
						$(".table #trEditItem").show();
	
						var recordToEdit = {};
			
						recordToEdit["credebtorsName"] = $("#" + selectedRecordId).children("#credebtorsName").html();
			
						recordToEdit["goodsBought"] = $("#" + selectedRecordId).children("#goodsBought").html();
			
						recordToEdit["amount"] = $("#" + selectedRecordId).children("#amount").html();
			
						recordToEdit["time"] = $("#" + selectedRecordId).children("#time").html();
			
						recordToEdit["notes"] = $("#" + selectedRecordId).children("#notes").attr("fullNote");
			
			
			
						$(".table #trEditItem #inpCredebtorsName").val(recordToEdit["credebtorsName"]);
		
						$(".table #trEditItem #inpGoodsBought").val(recordToEdit["goodsBought"]);
		
						$(".table #trEditItem #inpAmount").val(recordToEdit["amount"]);
		
						$(".table #trEditItem #inpNotes").val(recordToEdit["notes"]);
		
						$(".table #trEditItem #inpGoodName").focus();
	
					}
				
				}
			
			}
			
		
		}
		
		else {
		
			toast("Please select a row");
		
		}
	
	});
	
	$("#headIcon-strike").click(function() {
		
		if(selectedRecordId !== undefined) {
			
			for(var i = 0; i < credebt["details"].length; i++) {
			
				if(credebt["details"][i]["recordId"] == selectedRecordId) {
				
					if(credebt["details"][i]["striked"] == "true") {
					
						toast("Record already striked");
					
					}
					
					else {
					
						fullLoader();
						
						window.location.href = "../scripts/php/credebt.php?type=" + credebt["variables"]["type"].toLowerCase() + "&request=strike&record-id=" + selectedRecordId;
					
					}
					
				}
				
			}
					
		}
		
		else {
		
			toast("Please select a row");
		
		}
	
	});
	
	
	$(".table #trAddItem #inpGoodsBought").keyup(function() {
		
		var suggestionsArray = [];
		
		for(var i = 0; i < all["goods"].length; i++) {
			
			if(all["goods"][i].toLowerCase().indexOf($(".table #trAddItem #inpGoodsBought").val().toLowerCase()) !== -1) {
		
				suggestionsArray.push(all["goods"][i]);
				
			}
		
		}
		
		showInputSuggestions(suggestionsArray, $(this).attr("id"));
	
	});
	
	$(".table #trEditItem #inpGoodsBought").keyup(function() {
		
		var suggestionsArray = [];
		
		for(var i = 0; i < all["goods"].length; i++) {
			
			if(all["goods"][i].toLowerCase().indexOf($(".table #trEditItem #inpGoodsBought").val().toLowerCase()) !== -1) {
		
				suggestionsArray.push(all["goods"][i]);
				
			}
		
		}
		
		showInputSuggestions(suggestionsArray, $(this).attr("id"));
	
	});
	
	
	$(".table #trAddItem #inpCredebtorsName").keyup(function() {
		
		var suggestionsArray = [];
		
		for(var i = 0; i < all["customers"].length; i++) {
			
			if(all["customers"][i].toLowerCase().indexOf($(".table #trAddItem #inpCredebtorsName").val().toLowerCase()) !== -1) {
		
				suggestionsArray.push(all["customers"][i]);
				
			}
		
		}
		
		showInputSuggestions(suggestionsArray, $(this).attr("id"));
	
	});
	
	$(".table #trEditItem #inpCredebtorsName").keyup(function() {
		
		var suggestionsArray = [];
		
		for(var i = 0; i < all["customers"].length; i++) {
			
			if(all["customers"][i].toLowerCase().indexOf($(".table #trEditItem #inpCredebtorsName").val().toLowerCase()) !== -1) {
		
				suggestionsArray.push(all["customers"][i]);
				
			}
		
		}
		
		showInputSuggestions(suggestionsArray, $(this).attr("id"));
	
	});
	
	
	$(".table #frmAddItem").submit(function() {
		
		event.preventDefault();
		
		if($(".table #trAddItem #inpCredebtorsName").val() !== "" && $(".table #trAddItem #inpAmount").val() !== "") {
		
		$(".table #trAddItem").hide();
		
		var obj = {
			credebtorsName: $(".table #trAddItem #inpCredebtorsName").val(),
			goodsBought: $(".table #trAddItem #inpGoodsBought").val(),
			amount: $(".table #trAddItem #inpAmount").val(),
			note: $(".table #trAddItem #inpNotes").val()
		}
		
		fullLoader();
		
		window.location.href = "../scripts/php/credebt.php?type=" + credebt["variables"]["type"].toLowerCase() + "&request=add-record&obj=" + JSON.stringify(obj);
		
		}
		
		else {
		
			toast("Please fill in the details");
		
			$(".table #trAddItem #inpCredebtorsName").focus();
	
		}
	
	});
	
	$(".table #frmEditItem").submit(function() {
		
		event.preventDefault();
		
		if($(".table #trEditItem #inpCredebtorsName").val() !== "" && $(".table #trEditItem #inpAmount").val() !== "") {
		
		$(".table #trEditItem").hide();
		
		var obj = {
			credebtorsName: $(".table #trEditItem #inpCredebtorsName").val(),
			goodsBought: $(".table #trEditItem #inpGoodsBought").val(),
			amount: $(".table #trEditItem #inpAmount").val(),
			note: $(".table #trEditItem #inpNotes").val()
		}
		
		fullLoader();
		
		window.location.href = "../scripts/php/credebt.php?type=" + credebt["variables"]["type"].toLowerCase() + "&request=edit-record&record-id=" + selectedRecordId + "&obj=" + JSON.stringify(obj);
		
		}
		
		else {
		
			toast("Please fill in the details");
		
			$(".table #trAddItem #inpCredebtorsName").focus();
	
		}
	
	});
	
	
	cornerDropDown["functions"]["editHistory"] = function() {
		
		if(selectedRecordId !== undefined) {
			
			cornerDropDown.default.close();
		
			window.open("edit-history?id=" + selectedRecordId);
			
		}
		
		else {
		
			toast("Please select a row");
		
		}
	
	}
	
});
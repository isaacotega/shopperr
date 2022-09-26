function fetchGoodsDetailsForEditing() {
	
	fullLoader("Fetching good's details . . .");
			
	$.ajax({
		type: "GET",
		dataType: "JSON",
		url: portalInfo["rootPath"] + "scripts/php/goods.php",
		data: {
			request: "goodsInformation",
			goodId: selectedGood["goodId"]
		},
		success: function(response) {
		
			removeFullLoader();
		
			$("#goodsEditorPortal #inpGoodsName").val("");
			
 			$("#goodsEditorPortal #tagsHolder").html("");
 			
			$("#goodsEditorPortal #tblPricesList tbody").html("");
				
 			
			$("#goodsEditorPortal").css("display", "block");
			
			$("#goodsEditorPortal #inpGoodsName").val(response["name"]);
			
			for(var i = 0; i < response["priceObj"]["prices"].length; i++) {
			
				$("#goodsEditorPortal #tblPricesList tbody").append('<tr> <td id="tdQuantity">' + response["priceObj"]["quantities"][i].toLowerCase() + '</td> <td id="tdPrice">' + response["priceObj"]["prices"][i] + '</td> <td id="tdDelete">' + portalInfo["deleteIcon"] + '</td> </tr>');
			
				$("#goodsEditorPortal [id=tdDelete]").off("click");
	
				$("#goodsEditorPortal [id=tdDelete]").click(function() {
	
					$(this).parents("tr").remove();
	
				});
				
			}

			for(var i = 0; i < response["tags"].length; i++) {
			
 				var tagName = response["tags"][i].toUpperCase();
 				
 				var removeEvent = '$(this).parent(".tag").remove(); compileTags()';
 		
 				var tag = '<label class="tag" id="lblTags"> <label id="tagName">' + tagName + '</label> <label id="lblDeleteTag" onclick=\'' + removeEvent + '\'>x</label></label>';
 	
 				$("#goodsEditorPortal #tagsHolder").append(tag);
 			
 				compileTags_edit();
 				
			
			
			}
		
		//	alert(JSON.stringify(response)  );
		
		},
		error: function(response) {
			
			removeFullLoader();
		
			alert("Error fetching good's details");
		
		}
	});
	
	
	
}
	
var tagsArray_edit = [];
	
 function compileTags_edit() {
 		
 	tagsArray_edit = [];
 		
 	for(var i = 0; i < $("#goodsEditorPortal #tagsHolder").children(".tag").length; i++) {
 			
 		tagsArray_edit.push($("#goodsEditorPortal #tagsHolder").children(".tag").eq(i).children("#tagName").html().toLowerCase());
 		
 	}
 	
 }
 	
	
$(document).ready(function() {
	
	
	$("#goodsEditorPortal #inpTag").keyup(function() {
		
		var suggestionsArray = [];
		
		for(var i = 0; i < allGoods["tags"].length; i++) {
			
			if(allGoods["tags"][i].toLowerCase().indexOf($("#goodsEditorPortal #inpTag").val().toLowerCase()) !== -1) {
		
				suggestionsArray.push(allGoods["tags"][i]);
				
			}
		
		}
		
		showInputSuggestions(suggestionsArray, $(this).attr("id"));
	
	});
	
	$("#goodsEditorPortal #inpQuantity").keyup(function() {
		
		var suggestionsArray = [];
		
		for(var i = 0; i < allGoods["quantities"].length; i++) {
			
			if(allGoods["quantities"][i].toLowerCase().indexOf($("#goodsEditorPortal #inpQuantity").val().toLowerCase()) !== -1) {
		
				suggestionsArray.push(allGoods["quantities"][i]);
				
			}
		
		}
	
		showInputSuggestions(suggestionsArray, $(this).attr("id"));
	
	});
	
	
	$("#goodsEditorPortal #head #icnClose").click(function() {
	
		$("#goodsEditorPortal").css("display", "none");
	
	});
	
	$("#goodsEditorPortal #btnEditGood").click(function() {
	
		if($("#goodsEditorPortal #inpGoodsName").val() !== "") {
		
			var pricesArray = [];
			
			for(var i = 0; i < $("#goodsEditorPortal #tblPricesList tbody").children("tr").length; i++) {
				
				var eachPriceObj = {
					quantity: $("#goodsEditorPortal #tblPricesList tbody").children("tr").eq(i).children("#tdQuantity").html(),
					price: $("#goodsEditorPortal #tblPricesList tbody").children("tr").eq(i).children("#tdPrice").html()
				}
			
				pricesArray.push( eachPriceObj );
			
			}
		
			var newGoodObj = {
				id: selectedGood["goodId"],
				name: $("#goodsEditorPortal #inpGoodsName").val(),
				pricesArray: pricesArray,
				tagsArray: tagsArray_edit
			}
			
			window.location.href = portalInfo["rootPath"] + "scripts/php/goods.php?request=edit&obj=" + JSON.stringify(newGoodObj);
		
			fullLoader("Processing Request . . .");
		
		}
		
		else {
		
			toast("Please fill in the details");
		
		}
		
	});

	$("#goodsEditorPortal #btnAddPrice").click(function() {
	
		if($("#goodsEditorPortal #inpQuantity").val() !== "" && $("#goodsEditorPortal #inpPrice").val() !== "") {
			
			$("#goodsEditorPortal #tblPricesList tbody").append('<tr> <td id="tdQuantity">' + $("#goodsEditorPortal #inpQuantity").val().toLowerCase() + '</td> <td id="tdPrice">' + $("#goodsEditorPortal #inpPrice").val() + '</td> <td id="tdDelete">' + portalInfo["deleteIcon"] + '</td> </tr>');
			
			$("#goodsEditorPortal #inpQuantity").val("");
			
			$("#goodsEditorPortal #inpPrice").val("");
		
			$("#goodsEditorPortal [id=tdDelete]").off("click");
	
			$("#goodsEditorPortal [id=tdDelete]").click(function() {
	
				$(this).parents("tr").remove();
	
			});

		}
		
		else {
		
			toast("Please fill in the details");
		
		}
	
	});
	
 	$("#goodsEditorPortal #frmAddTag").submit(function() {
 		
 		event.preventDefault();
 		
 		if($("#goodsEditorPortal #inpTag").val() !== "") {
 			
 			if($("#goodsEditorPortal #tagsHolder").children(".tag").length < 11) {
 		
 				var tagName = $("#goodsEditorPortal #inpTag").val().toUpperCase();
 				
 				var removeEvent = '$(this).parent(".tag").remove(); compileTags()';
 		
 				var tag = '<label class="tag" id="lblTags"> <label id="tagName">' + tagName + '</label> <label id="lblDeleteTag" onclick=\'' + removeEvent + '\'>x</label></label>';
 	
 				$("#goodsEditorPortal #tagsHolder").append(tag);
 			
 				$("#goodsEditorPortal #inpTag").val("");
 				
 				compileTags_edit();
 				
 			}
 			
 			else {
 			
 				alert("You can have a maximum of ten tags");
 			
 			}
 			
 		}
 	
 		else {
 			
 			alert("Please enter a tag name");
 			
 		}
 			
 	});
 	
});
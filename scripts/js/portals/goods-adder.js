$(document).ready(function() {
	
	var tagsArray = [];
	
	
	$("#goodsAdderPortal #inpTag").keyup(function() {
		
		var suggestionsArray = [];
		
		for(var i = 0; i < allGoods["tags"].length; i++) {
			
			if(allGoods["tags"][i].toLowerCase().indexOf($("#goodsAdderPortal #inpTag").val().toLowerCase()) !== -1) {
		
				suggestionsArray.push(allGoods["tags"][i]);
				
			}
		
		}
		
		showInputSuggestions(suggestionsArray, $(this).attr("id"));
	
	});
	
	$("#goodsAdderPortal #inpQuantity").keyup(function() {
		
		var suggestionsArray = [];
		
		for(var i = 0; i < allGoods["quantities"].length; i++) {
			
			if(allGoods["quantities"][i].toLowerCase().indexOf($("#goodsAdderPortal #inpQuantity").val().toLowerCase()) !== -1) {
		
				suggestionsArray.push(allGoods["quantities"][i]);
				
			}
		
		}
	
		showInputSuggestions(suggestionsArray, $(this).attr("id"));
	
	});
	
	
	
	$("#goodsAdderPortal #head #icnClose").click(function() {
	
		$("#goodsAdderPortal").css("display", "none");
	
	});
	
	$("#goodsAdderPortal #btnAddGood").click(function() {
	
		if($("#goodsAdderPortal #inpGoodsName").val() !== "") {
		
			var pricesArray = [];
			
			for(var i = 0; i < $("#goodsAdderPortal #tblPricesList tbody").children("tr").length; i++) {
				
				var eachPriceObj = {
					quantity: $("#goodsAdderPortal #tblPricesList tbody").children("tr").eq(i).children("#tdQuantity").html(),
					price: $("#goodsAdderPortal #tblPricesList tbody").children("tr").eq(i).children("#tdPrice").html()
				}
			
				pricesArray.push( eachPriceObj );
			
			}
		
			var newGoodObj = {
				name: $("#goodsAdderPortal #inpGoodsName").val(),
				pricesArray: pricesArray,
				tagsArray: tagsArray
			}
			
			window.location.href = portalInfo["rootPath"] + "scripts/php/goods.php?request=add&obj=" + JSON.stringify(newGoodObj);
			
			fullLoader("Processing Request . . .");
		
		}
		
		else {
		
			toast("Please fill in the details");
		
		}
		
	});

	$("#goodsAdderPortal #btnAddPrice").click(function() {
	
		if($("#goodsAdderPortal #inpQuantity").val() !== "" && $("#goodsAdderPortal #inpPrice").val() !== "") {
			
			$("#goodsAdderPortal #tblPricesList tbody").append('<tr> <td id="tdQuantity">' + $("#goodsAdderPortal #inpQuantity").val().toLowerCase() + '</td> <td id="tdPrice">' + $("#goodsAdderPortal #inpPrice").val() + '</td> <td id="tdDelete">' + portalInfo["deleteIcon"] + '</td> </tr>');
			
			$("#goodsAdderPortal #inpQuantity").val("");
			
			$("#goodsAdderPortal #inpPrice").val("");
		
			$("#goodsAdderPortal [id=tdDelete]").off("click");
	
			$("#goodsAdderPortal [id=tdDelete]").click(function() {
	
				$(this).parents("tr").remove();
	
			});

		}
		
		else {
		
			toast("Please fill in the details");
		
		}
	
	});
	
 	$("#goodsAdderPortal #frmAddTag").submit(function() {
 		
 		event.preventDefault();
 		
 		if($("#goodsAdderPortal #inpTag").val() !== "") {
 			
 			if($("#goodsAdderPortal #tagsHolder").children(".tag").length < 11) {
 		
 				var tagName = $("#goodsAdderPortal #inpTag").val().toUpperCase();
 				
 				var removeEvent = '$(this).parent(".tag").remove(); compileTags()';
 		
 				var tag = '<label class="tag" id="lblTags"> <label id="tagName">' + tagName + '</label> <label id="lblDeleteTag" onclick=\'' + removeEvent + '\'>x</label></label>';
 	
 				$("#goodsAdderPortal #tagsHolder").append(tag);
 			
 				$("#goodsAdderPortal #inpTag").val("");
 				
 				compileTags_add();
 				
 			}
 			
 			else {
 			
 				alert("You can have a maximum of ten tags");
 			
 			}
 			
 		}
 	
 		else {
 			
 			alert("Please enter a tag name");
 			
 		}
 			
 	});
 	
 	function compileTags_add() {
 		
 		tagsArray = [];
 		
 		for(var i = 0; i < $("#goodsAdderPortal #tagsHolder").children(".tag").length; i++) {
 			
 			tagsArray.push($("#goodsAdderPortal #tagsHolder").children(".tag").eq(i).children("#tagName").html().toLowerCase());
 		
 		}
 	
 	}
 	
});
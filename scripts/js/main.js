$(document).ready(function() {

	$("#navIcon").click(function() {
		
		$("#sideNav").css("width", "100%");
		
	});

	$("#sideNav").click(function() {
		
		$("#sideNav").css("width", "0%");
		
	});
	
	$("#sideNav .sideLinks").parents("a").click(function() {
		
		fullLoader();
		
	});
	
	$("#sideNav #sdLnkExit").click(function() {
		
		if(typeof Android !== "undefined" && Android !== null) {
	
			Android.exit();
	
		}
		
		else {
		
			window.close();
		
		}
		
	});
	
});

function fullLoader(statement) {
	
	removeFullLoader();
		
	var statement = statement !== undefined ? statement : "Loading . . .";
	
	var loader = $('<div id="fullLoader"> <div id="loaderHolder"> <div id="loader"></div> </div> <br> <div id="statement">' + statement + '</div> </div>');
	
	$("body #main").append(loader);
	
}
	
function removeFullLoader() {
		
	$("[id=fullLoader]").remove();
	
}
	
function placeholder(element, text) {
	
	if(text !== false) {
		
		var placeholder = '<div id="placeholder">' + text + '</div>';
	
	}
	
	else {
	
		var placeholder = "";
	
	}
	
	$(element).html(placeholder);
	
}

function toast(text) {

	if(typeof Android !== "undefined" && Android !== null) {
	
		Android.toast(text);
	
	}
	
	else {

		alert(text);
		
	}
	
}

function showInputSuggestions(suggestionsArray, activeElementId) {
	
	var newSuggestionsArray = [];
	
	for(var i = 0; i < suggestionsArray.length; i++) {
		
		if(newSuggestionsArray.indexOf(suggestionsArray[i]) == -1) {
	
			newSuggestionsArray.push(suggestionsArray[i]);
			
		}
		
	}
	
	suggestionsArray = newSuggestionsArray;
	
	if(suggestionsArray.length == 0) {
	
		removeInputSuggestions();
		
		return;
	
	}
	
	$("#inputSuggestions #container").html("");
		
	$("#inputSuggestions").css("display", "block");
		
	for(var i = 0; i < suggestionsArray.length; i++) {
		
		if(suggestionsArray[i] !== "") {
	
			$("#inputSuggestions #container").append('<span onclick=\'$(' + activeElementId + ').val("' + suggestionsArray[i] + '"); removeInputSuggestions(); $("#' + activeElementId + '").focus(); \' class="suggestion"> <label id="text">' + suggestionsArray[i] + '</label> </span>');
			
		}
	
	}
	
	$("#" + activeElementId).attr("onblur", "setTimeout(function() {removeInputSuggestions(); }, 500);");
	
}

function removeInputSuggestions() {
	
	$("#inputSuggestions #container").html("");
		
	$("#inputSuggestions").css("display", "none");
		
}
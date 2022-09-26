//$(document).ready(function() {

var cornerDropDown = {
	default: {
		close: function() {
			
			setTimeout(function() {
		
				$("#cornerDropDown").css({
					width: "0",
					height: "0"
				});
				
			}, 200);

			$("#cornerDropDown #container").css({
				width: "0",
				height: "0"
			});
	
		},
		open: function() {

			$("#cornerDropDown").css({
				width: "100%",
				height: "100%"
			});

			$("#cornerDropDown #container").css({
				width: "10cm",
				height: dropDownList["originalHeight"]
			});
	
		}
	},
	functions: {}
}
	
var dropDownList = {}

dropDownList["originalHeight"] = $("#cornerDropDown #container").css("height");

$("#cornerDropDown #container").css({
	height: 0
});

$("#headIcon-menu").click(function() {

	cornerDropDown.default.open();
	
});

$("#cornerDropDown #background").click(function() {
	
	cornerDropDown.default.close();
	
});

//});
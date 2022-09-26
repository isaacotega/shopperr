<?php
	
function toast($text) {

	echo '<script>
	
		if(typeof Android !== "undefined" && Android !== null) {
	
			Android.toast("' . $text . '");
	
		}
	
		else {

			alert("' . $text . '");
		
		}
		
		</script>';

	}
	
	function placeholder($element, $text) {
	
		echo '<script> placeholder("' . $element . '", "' . $text . '"); </script>';
	
	}
	
	function relocate($url) {
	
		die('<script> document.location.replace("' . $url . '"); </script>');
	
	}
	
 ?>